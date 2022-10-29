<?php
namespace Maps;

use Maps\Controller\IndexController;
use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Maps\Controller\IndexControllerFactory;
use Maps\Model\Mapmarker;

return [
    'router' => [
        'routes' => [
            'maps' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/maps',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            Mapmarker::class => InvokableFactory::class,
        ],
    ],
    'controllers' => [
        'factories' => [
            IndexController::class => IndexControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
