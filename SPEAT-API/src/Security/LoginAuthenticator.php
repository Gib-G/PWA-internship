<?php


namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\HttpUtils;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\PropertyAccess\Exception\AccessException;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\PasswordUpgradeBadge;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;


class LoginAuthenticator extends AbstractAuthenticator implements AuthenticatorInterface 
{
    private $options;
    private $httpUtils;
    private $userProvider;
    private $propertyAccessor;
    private $successHandler;
    private $failureHandler;

    /**
     * @var TranslatorInterface|null
     */
    private $translator;

    public function __construct(HttpUtils $httpUtils, UserProviderInterface $userProvider, ?AuthenticationSuccessHandlerInterface $successHandler = null, ?AuthenticationFailureHandlerInterface $failureHandler = null, array $options = [], ?PropertyAccessorInterface $propertyAccessor = null)
    {
        $this->options = array_merge(['username_path' => 'username', 'password_path' => 'password'], $options);
        $this->httpUtils = $httpUtils;
        $this->successHandler = $successHandler;
        $this->failureHandler = $failureHandler;
        $this->userProvider = $userProvider;
        $this->propertyAccessor = $propertyAccessor ?: PropertyAccess::createPropertyAccessor();
    }

    public function supports(Request $request): ?bool
    {
        if (false === strpos($request->getRequestFormat(), 'json') && false === strpos($request->getContentType(), 'json')) {
            return false;
        }

        if (isset($this->options['check_path']) && !$this->httpUtils->checkRequestPath($request, $this->options['check_path'])) {
            return false;
        }
        if($request->getPathInfo() === '/api/login'){

            return true;
        };
        return false;
    }

    public function authenticate(Request $request): PassportInterface
    {
        try {
            $credentials = $this->getCredentials($request);
        } catch (BadRequestHttpException $e) {
            $request->setRequestFormat('json');

            throw $e;
        }

        // @deprecated since 5.3, change to $this->userProvider->loadUserByIdentifier() in 6.0
        $method = 'loadUserByIdentifier';
        if (!method_exists($this->userProvider, 'loadUserByIdentifier')) {
            trigger_deprecation('symfony/security-core', '5.3', 'Not implementing method "loadUserByIdentifier()" in user provider "%s" is deprecated. This method will replace "loadUserByUsername()" in Symfony 6.0.', get_debug_type($this->userProvider));

            $method = 'loadUserByUsername';
        }

        $passport = new Passport(
            new UserBadge($credentials['username'], [$this->userProvider, $method]),
            new PasswordCredentials($credentials['password'])
        );
        if ($this->userProvider instanceof PasswordUpgraderInterface) {
            $passport->addBadge(new PasswordUpgradeBadge($credentials['password'], $this->userProvider));
        }
        if ($passport->getUser()->getConfirmationToken() !== null){
            return new Passport(new UserBadge('',null),new PasswordCredentials(''));
        }

        return $passport;
    }

    // public function createAuthenticatedToken(PassportInterface $passport, string $firewallName): TokenInterface
    // {
    //     return new UsernamePasswordToken($passport->getUser(), null, $firewallName, $passport->getUser()->getRoles());
    
    // }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // if (null === $this->successHandler) {
        //     return null; // let the original request continue
        // }
        // dd('hi');
        // return $this->successHandler->onAuthenticationSuccess($request, $token);
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        if (null === $this->failureHandler) {
            if (null !== $this->translator) {
                $errorMessage = $this->translator->trans($exception->getMessageKey(), $exception->getMessageData(), 'security');
            } else {
                $errorMessage = strtr($exception->getMessageKey(), $exception->getMessageData());
            }

            return new JsonResponse(['error' => $errorMessage], JsonResponse::HTTP_UNAUTHORIZED);
        }

        return $this->failureHandler->onAuthenticationFailure($request, $exception);
    }

    // public function isInteractive(): bool
    // {
    //     return true;
    // }

    public function setTranslator(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    private function getCredentials(Request $request)
    {
        $data = json_decode($request->getContent());
        if (!$data instanceof \stdClass) {
            throw new BadRequestHttpException('Invalid JSON.');
        }

        $credentials = [];
        try {
            $credentials['username'] = $this->propertyAccessor->getValue($data, $this->options['username_path']);

            if (!\is_string($credentials['username'])) {
                throw new BadRequestHttpException(sprintf('The key "%s" must be a string.', $this->options['username_path']));
            }

            if (\strlen($credentials['username']) > Security::MAX_USERNAME_LENGTH) {
                throw new BadCredentialsException('Invalid username.');
            }
        } catch (AccessException $e) {
            throw new BadRequestHttpException(sprintf('The key "%s" must be provided.', $this->options['username_path']), $e);
        }

        try {
            $credentials['password'] = $this->propertyAccessor->getValue($data, $this->options['password_path']);

            if (!\is_string($credentials['password'])) {
                throw new BadRequestHttpException(sprintf('The key "%s" must be a string.', $this->options['password_path']));
            }
        } catch (AccessException $e) {
            throw new BadRequestHttpException(sprintf('The key "%s" must be provided.', $this->options['password_path']), $e);
        }

        return $credentials;
    }
}
