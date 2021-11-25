<?php

namespace App\Security\Voter;

use App\Entity\Restaurant;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class RestaurantVoter extends Voter
{
    const RESTAURANT_EDIT = 'restaurant_edit';
    
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $restaurant): bool
    {

        return in_array($attribute, [self::RESTAURANT_EDIT])
            && $restaurant instanceof Restaurant;
    }

    protected function voteOnAttribute(string $attribute, $restaurant, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::RESTAURANT_EDIT:
                $owners = $restaurant->getPersonnel();
        
                foreach($owners as $owner){
                    if( $user === $owner){
        
                        return true;
                    }
                };
                if ($this->security->isGranted('ROLE_ADMIN')) {
                    return true;
                }
        }

        return false;
    }

}
