<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Facade URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the stats collection command to fetch the facade APIs
    | current stats with, the URL should be pointing to the /v1/stats route
    | on the facade API instance.
    |
    */

    'url' => env('FACADE_STATS_URL', null),
];
