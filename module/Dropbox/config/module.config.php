<?php

namespace Dropbox;

use Dropbox\Controller\IndexController;
use Dropbox\Service\Dropbox;
use Dropbox\Form\FileForm;
use Laminas\Mvc\Controller\LazyControllerAbstractFactory;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;

return [
    'router' => [
        'routes' => [
            'dropbox' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/dropbox',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'default' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '[/:action]',
                            'defaults' => [
                                'controller' => IndexController::class,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            IndexController::class => LazyControllerAbstractFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            Dropbox::class => ReflectionBasedAbstractFactory::class,
            FileForm::class => ReflectionBasedAbstractFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'dropbox' => [
        'key' => 'pugnp3cpwobp4cy',
        'secret' => 's2ho95tnebwlzor',
    ],
];