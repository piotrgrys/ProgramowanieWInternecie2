<?php
return [
    'router' => [
        'routes' => [
            'genres.rest.genres' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/genres[/:genres_id]',
                    'defaults' => [
                        'controller' => 'Genres\\V1\\Rest\\Genres\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'genres.rest.genres',
        ],
    ],
    'api-tools-rest' => [
        'Genres\\V1\\Rest\\Genres\\Controller' => [
            'listener' => 'Genres\\V1\\Rest\\Genres\\GenresResource',
            'route_name' => 'genres.rest.genres',
            'route_identifier_name' => 'genres_id',
            'collection_name' => 'genres',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Genres\V1\Rest\Genres\GenresEntity::class,
            'collection_class' => \Genres\V1\Rest\Genres\GenresCollection::class,
            'service_name' => 'genres',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'Genres\\V1\\Rest\\Genres\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Genres\\V1\\Rest\\Genres\\Controller' => [
                0 => 'application/vnd.genres.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Genres\\V1\\Rest\\Genres\\Controller' => [
                0 => 'application/vnd.genres.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'api-tools-hal' => [
        'metadata_map' => [
            \Genres\V1\Rest\Genres\GenresEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'genres.rest.genres',
                'route_identifier_name' => 'genres_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializableHydrator::class,
            ],
            \Genres\V1\Rest\Genres\GenresCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'genres.rest.genres',
                'route_identifier_name' => 'genres_id',
                'is_collection' => true,
            ],
        ],
    ],
    'api-tools' => [
        'db-connected' => [
            'Genres\\V1\\Rest\\Genres\\GenresResource' => [
                'adapter_name' => 'xampp',
                'table_name' => 'genres',
                'hydrator_name' => \Laminas\Hydrator\ArraySerializableHydrator::class,
                'controller_service_name' => 'Genres\\V1\\Rest\\Genres\\Controller',
                'entity_identifier_name' => 'id',
            ],
        ],
    ],
    'api-tools-content-validation' => [
        'Genres\\V1\\Rest\\Genres\\Controller' => [
            'input_filter' => 'Genres\\V1\\Rest\\Genres\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Genres\\V1\\Rest\\Genres\\Validator' => [
            0 => [
                'name' => 'name',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Laminas\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => '255',
                        ],
                    ],
                ],
            ],
        ],
    ],
];
