<?php
namespace Mapspoints;

use Mapspoints\Controller\IndexController;
use Mapspoints\Controller\IndexControllerFactory;
use Mapspoints\Form\MapmarkerForm;
use Mapspoints\Model\Mapmarker;
use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;

return [
    'router' => [
        'routes' => [
            'mapspoints' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/mapspoints',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action'     => 'index',
                    ],
                ],
                'child_routes' => [
                    'add' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '[/:action[/:id]]',
                            'defaults' => [
                                'controller' => IndexController::class,
                            ],
                        ],
                    ],
                    'list' => [
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
        'factories' => [
            Mapmarker::class => InvokableFactory::class,
            MapmarkerForm::class => ReflectionBasedAbstractFactory::class,
        ],
    ],
    'controllers' => [
        'factories' => [
            //IndexController::class => InvokableFactory::class,
            IndexController::class => IndexControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
