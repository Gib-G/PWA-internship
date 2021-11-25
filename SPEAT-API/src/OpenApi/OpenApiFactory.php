<?php

namespace App\OpenApi;

use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use ApiPlatform\Core\OpenApi\Model\RequestBody;
use ApiPlatform\Core\OpenApi\OpenApi;
use ArrayObject;

class OpenApiFactory implements OpenApiFactoryInterface
{

    private $decorated;

    public function __construct(OpenApiFactoryInterface $decorated)
    {
        $this->decorated = $decorated;

    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = $this->decorated->__invoke($context);

        // $openApi->getPaths()->addPath('/ping', new PathItem(null,'Ping', null, new Operation('ping-id', [], [], 'Respond')));

        // Fonction pour cacher les chemins get qu'on marque 'hidden' dans le summary
        foreach($openApi->getPaths()->getPaths() as $key => $path){
            if($path->getGet() && $path->getGet()->getSummary() == 'hidden'){
                $openApi->getPaths()->addPath($key, $path->withGet(null));
            }
        };

        // Authentification Cookie
        $schemas = $openApi->getComponents()->getSecuritySchemes();
        $schemas['cookieAuth'] = new ArrayObject([
            'type' => 'apiKey',
            'in' => 'cookie',
            'name' => 'PHPSESSID',
        ]);

        // Suppression de parametres pour la méthod get de chemin MonCompte
        $monCompteOperation = $openApi->getPaths()->getPath('/api/moncompte')->getGet()->withParameters([]);
        $monComptePathItem = $openApi->getPaths()->getPath('/api/moncompte')->withGet($monCompteOperation);
        $openApi->getPaths()->addPath('/api/moncompte', $monComptePathItem);
        
        
        // Ajout de chemin Login
        $schemas = $openApi->getComponents()->getSchemas();
        $schemas['Credentials'] = new ArrayObject([
            'type' => 'object',
            'properties' => [
                'username' => [
                    'type' => 'string',
                ],
                'password' => [
                    'type' => 'string',
                ],
            ],
        ]);
        
        $openApi->getPaths()->addPath('/api/login', new PathItem(null, null, null, null, null, new Operation('PostApiLogin', ['Auth'], [
            '200' => [
                'description' => 'Utilisateur connecté',
                'content' => [
                    'application/json' => [
                        'schema' => [
                            '$ref' => '#/components/schemas/Utilisateur-read.user',
                        ],
                    ],
                ],
            ],
        ], 'Chemin Login', '', null, [], new RequestBody('', new ArrayObject([
            'application/json' => [
                'schema' => [
                    '$ref' => '#/components/schemas/Credentials',
                ],
            ],
        ])))));
        
        // Ajout de chemin Logout
        $openApi->getPaths()->addPath('/logout', new PathItem(null, null, null, null, null, new Operation('PostApiLogout', ['Auth'], ['204' => []], 'Chemin Logout', '', null, [], )));
        



        $schemas = $openApi->getComponents()->getSchemas();
        $schemas['ForgotPasswordEmail'] = new ArrayObject([
            'type' => 'object',
            'properties' => [
                'Email' => [
                    'type' => 'string',
                ],
            ],
        ]);

        $openApi->getPaths()->addPath('/api/forgot_password', new PathItem(null, null, null, null,null,new Operation('ForgotPassword', ['Auth'], [
            '200' => [
                'description' => 'Mail de Réinitialisation Envoyé',]
        ], 'Réinitialisation de mot de passe', '', null, [], new RequestBody('', new ArrayObject([
            'application/json' => [
                'schema' => [
                    '$ref' => '#/components/schemas/ForgotPasswordEmail',
                ],
            ],
        ])))));

        return $openApi;
        
    }
    
}



        // $pathItem = new PathItem(
        //     post: new Operation(
        //         operationId: 'postApiLogin',
        //         tags: ['Utilisteur'],
        //         requestBody: new RequestBody(
        //             content: new ArrayObject([
        //                 'application/json' => [
        //                     'schema' => [
        //                         '$ref' => '#/components/schemas/Credentials'
        //                     ]
        //                 ]
        //             ])
        //         ),
        //         responses: [
        //             '200' => [
        //                 'description' => 'Utilisateur connecté',
        //                 'content' => [
        //                     'application/json' => [
        //                         'schema' => [
        //                             '$ref' => '#/components/schemas/Utilisateur-read.user'
        //                         ]
        //                     ]
        //                 ]
        //             ]
        //         ]
        //     )
        // );