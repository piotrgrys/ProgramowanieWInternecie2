<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

declare(strict_types=1);

use Laminas\ApiTools\Admin\InputFilter\RpcService\PostInputFilter as RpcPostInputFilter;


return [
    'input_filters' => [
        'aliases' => [
            'ZF\Apigility\Admin\InputFilter\RpcService\PostInputFilter' => RpcPostInputFilter::class,
        ],
    ],
];
