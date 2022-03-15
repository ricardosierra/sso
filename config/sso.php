<?php

return [
    'sso_server' => env('SSO_SERVER'),
    'sso_broker_id' => env('SSO_BROKER_ID'),
    'sso_broker_secret' => env('SSO_BROKER_SECRET'),
    'server_prefix' => env('SSO_SERVER_PREFIX', '/'),
    'type' => env('SSO_TYPE', 'broker'),
    'log_erros' => env('APP_DEBUG', false),


    /*
    |--------------------------------------------------------------------------
    | Server Configuration
    |--------------------------------------------------------------------------
    */

    //Do you want to serve the login form on your server?
    'login_on_server' => true,

    //In case of no redirect defined, where we'll redirect him?
    'no_redirect_defined' => [
        'mode' => 'url',
        'destination' => '/home',
    ],

    //When Serving the login form on your server, what's the login form view?
    'login_view' => 'login',

    /*
     |--------------------------------------------------------------------------
     | Brokers Configuration
     |--------------------------------------------------------------------------
     */

    // Table used in App\Models\Broker model
    'brokersTable' => 'brokers',
    'brokersModel' => App\Models\Broker::class,

    /*
     |--------------------------------------------------------------------------
     | User Configuration
     |--------------------------------------------------------------------------
     */

    'usersModel' => \App\User::class,

    'userTableName' => 'users',
    'userUserNameField' => 'email',
    'userPasswordField' => 'password',

    // Logged in user fields sent to brokers.
    'userFields' => [
        // Return array field name => database column name
        'id' => 'id',
    ],

];