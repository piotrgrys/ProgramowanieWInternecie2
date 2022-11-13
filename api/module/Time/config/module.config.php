<?php
return [
    'controllers' => [
        'factories' => [
            'Time\\V1\\Rpc\\Timestamp\\Controller' => \Time\V1\Rpc\Timestamp\TimestampControllerFactory::class,
            'Time\\V1\\Rpc\\ConvertToTimestamp\\Controller' => \Time\V1\Rpc\ConvertToTimestamp\ConvertToTimestampControllerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'time.rpc.timestamp' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/timestamp',
                    'defaults' => [
                        'controller' => 'Time\\V1\\Rpc\\Timestamp\\Controller',
                        'action' => 'timestamp',
                    ],
                ],
            ],
            'time.rpc.convert-to-timestamp' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/convert-to-timestamp',
                    'defaults' => [
                        'controller' => 'Time\\V1\\Rpc\\ConvertToTimestamp\\Controller',
                        'action' => 'convertToTimestamp',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'time.rpc.timestamp',
            1 => 'time.rpc.convert-to-timestamp',
        ],
    ],
    'api-tools-rpc' => [
        'Time\\V1\\Rpc\\Timestamp\\Controller' => [
            'service_name' => 'Timestamp',
            'http_methods' => [
                0 => 'GET',
            ],
            'route_name' => 'time.rpc.timestamp',
        ],
        'Time\\V1\\Rpc\\ConvertToTimestamp\\Controller' => [
            'service_name' => 'ConvertToTimestamp',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'time.rpc.convert-to-timestamp',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'Time\\V1\\Rpc\\Timestamp\\Controller' => 'Json',
            'Time\\V1\\Rpc\\ConvertToTimestamp\\Controller' => 'Json',
        ],
        'accept_whitelist' => [
            'Time\\V1\\Rpc\\Timestamp\\Controller' => [
                0 => 'application/vnd.time.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'Time\\V1\\Rpc\\ConvertToTimestamp\\Controller' => [
                0 => 'application/vnd.time.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
        ],
        'content_type_whitelist' => [
            'Time\\V1\\Rpc\\Timestamp\\Controller' => [
                0 => 'application/vnd.time.v1+json',
                1 => 'application/json',
            ],
            'Time\\V1\\Rpc\\ConvertToTimestamp\\Controller' => [
                0 => 'application/vnd.time.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'api-tools-content-validation' => [
        'Time\\V1\\Rpc\\ConvertToTimestamp\\Controller' => [
            'input_filter' => 'Time\\V1\\Rpc\\ConvertToTimestamp\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Time\\V1\\Rpc\\ConvertToTimestamp\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\Date::class,
                        'options' => [],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                        'options' => [],
                    ],
                ],
                'name' => 'date',
            ],
        ],
    ],
];
