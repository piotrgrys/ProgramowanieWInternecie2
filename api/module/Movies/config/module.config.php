<?php
return [
    'router' => [
        'routes' => [
            'movies.rest.movies' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/movies[/:movies_id]',
                    'defaults' => [
                        'controller' => 'Movies\\V1\\Rest\\Movies\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'movies.rest.movies',
        ],
    ],
    'api-tools-rest' => [
        'Movies\\V1\\Rest\\Movies\\Controller' => [
            'listener' => 'Movies\\V1\\Rest\\Movies\\MoviesResource',
            'route_name' => 'movies.rest.movies',
            'route_identifier_name' => 'movies_id',
            'collection_name' => 'movies',
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
            'entity_class' => \Movies\V1\Rest\Movies\MoviesEntity::class,
            'collection_class' => \Movies\V1\Rest\Movies\MoviesCollection::class,
            'service_name' => 'movies',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'Movies\\V1\\Rest\\Movies\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Movies\\V1\\Rest\\Movies\\Controller' => [
                0 => 'application/vnd.movies.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Movies\\V1\\Rest\\Movies\\Controller' => [
                0 => 'application/vnd.movies.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'api-tools-hal' => [
        'metadata_map' => [
            \Movies\V1\Rest\Movies\MoviesEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'movies.rest.movies',
                'route_identifier_name' => 'movies_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializableHydrator::class,
            ],
            \Movies\V1\Rest\Movies\MoviesCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'movies.rest.movies',
                'route_identifier_name' => 'movies_id',
                'is_collection' => true,
            ],
        ],
    ],
    'api-tools' => [
        'db-connected' => [
            'Movies\\V1\\Rest\\Movies\\MoviesResource' => [
                'adapter_name' => 'xampp',
                'table_name' => 'movies',
                'hydrator_name' => \Laminas\Hydrator\ArraySerializableHydrator::class,
                'controller_service_name' => 'Movies\\V1\\Rest\\Movies\\Controller',
                'entity_identifier_name' => 'id',
            ],
        ],
    ],
    'api-tools-content-validation' => [
        'Movies\\V1\\Rest\\Movies\\Controller' => [
            'input_filter' => 'Movies\\V1\\Rest\\Movies\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Movies\\V1\\Rest\\Movies\\Validator' => [
            0 => [
                'name' => 'title',
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
            1 => [
                'name' => 'year',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StripTags::class,
                    ],
                    1 => [
                        'name' => \Laminas\Filter\Digits::class,
                    ],
                ],
                'validators' => [],
            ],
            2 => [
                'name' => 'rating',
                'required' => true,
                'filters' => [],
                'validators' => [],
            ],
            3 => [
                'name' => 'link',
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
            4 => [
                'name' => 'genre_id',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StripTags::class,
                    ],
                    1 => [
                        'name' => \Laminas\Filter\Digits::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => 'Laminas\\ApiTools\\ContentValidation\\Validator\\DbRecordExists',
                        'options' => [
                            'adapter' => 'xampp',
                            'table' => 'genres',
                            'field' => 'id',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'api-tools-mvc-auth' => [
        'authorization' => [
            'Movies\\V1\\Rest\\Movies\\Controller' => [
                'collection' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
            ],
        ],
    ],
];
