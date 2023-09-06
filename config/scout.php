<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Search Engine
    |--------------------------------------------------------------------------
    |
    | This option controls the default search connection that gets used while
    | using Scout. This connection is used when syncing all models to the
    | search service. You should adjust this based on your own needs.
    |
    */

    'default' => env('SCOUT_DRIVER', 'algolia'),

    /*
    |--------------------------------------------------------------------------
    | Search Index
    |--------------------------------------------------------------------------
    |
    | This key is used to identify the search index or indices where your
    | records will be stored. You may use a single index for all of your
    | records, or compose an array of indices for each model.
    |
    */

    'index' => env('SCOUT_PREFIX', '').env('APP_ENV', ''),

    /*
    |--------------------------------------------------------------------------
    | Queue Data Syncing
    |--------------------------------------------------------------------------
    |
    | This option allows you to control if the operations that sync your data
    | with your search engines are queued. When this is set to "true" then
    | all automatic data syncing will get queued for better performance.
    |
    */

    'queue' => true,

    /*
    |--------------------------------------------------------------------------
    | Algolia Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your Algolia settings. Algolia is a cloud hosted
    | search engine which works great with Scout out of the box. Just
    | add your application ID and admin API key to get started.
    |
    */

    'algolia' => [
        'id' => env('ALGOLIA_APP_ID', ''),
        'secret' => env('ALGOLIA_SECRET', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | Elasticsearch Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your Elasticsearch settings. You may set a
    | custom host and port here if needed. If not, the default host and
    | port will be used when connecting to Elasticsearch.
    |
    */

    'elasticsearch' => [
        'index' => env('ELASTICSEARCH_INDEX', 'default'),
        'config' => [
            'hosts' => [
                env('ELASTICSEARCH_HOST', 'localhost'),
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Meilisearch Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your Meilisearch settings. Meilisearch is
    | a self-hosted search engine. You should provide the host (URL)
    | and the API key for your Meilisearch instance.
    |
    */

    'meilisearch' => [
        'host' => env('MEILISEARCH_HOST', 'http://127.0.0.1:7700'),
        'key' => env('MEILISEARCH_KEY', ''),
    ],

];
