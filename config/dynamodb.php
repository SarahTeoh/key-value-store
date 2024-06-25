<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default DynamoDb Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the DynamoDb connections below you wish
    | to use as your default connection for all DynamoDb work.
    */

    'default' => env('DYNAMODB_CONNECTION', 'aws'),

    /*
    |--------------------------------------------------------------------------
    | DynamoDb Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the DynamoDb connections setup for your application.
    |
    | Most of the connection's config will be fed directly to AwsClient
    | constructor http://docs.aws.amazon.com/aws-sdk-php/v3/api/class-Aws.AwsClient.html#___construct
    */
    'table_name' => env('DYNAMODB_TABLE_NAME'),
    'connections' => [
        'aws' => [
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
                'token' => env('AWS_SESSION_TOKEN'),
            ],
            'region' => env('AWS_REGION'),
            'debug' => env('DYNAMODB_DEBUG'),
        ],
        'aws_iam_role' => [
            'region' => env('AWS_REGION'),
            'debug' => env('DYNAMODB_DEBUG'),
        ],
        'local' => [
            'credentials' => [
                'key' => 'dynamodblocal',
                'secret' => 'secret',
            ],
            'region' => 'ap-southeast-1',
            'endpoint' => env('DYNAMODB_LOCAL_ENDPOINT'),
            'debug' => true,
        ],
        'test' => [
            'credentials' => [
                'key' => 'dynamodblocal',
                'secret' => 'secret',
            ],
            'region' => 'ap-southeast-1',
            'endpoint' => env('DYNAMODB_LOCAL_ENDPOINT'),
            'debug' => true,
        ],
    ],
];
