<?php

namespace Flickr;

use Flickr\Controller\IndexController;
use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'flickr' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/flickr',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'default' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '[/:action[/:id]]',
                            'defaults' => [
                                'controller' => IndexController::class,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [

    ],
    'controllers' => [
        'factories' => [
			IndexController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
