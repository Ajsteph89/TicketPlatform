<?php

return [
    'GET' => [
        '/' => 'TestController@index',

        //Auth
        '/register' => 'AuthController@showRegister',
        '/login' => 'AuthController@showLogin',
        '/logout' => 'AuthController@logout',

        //EVENTS
        '/organizer/events' => 'EventAdminController@index',
        '/organizer/events/create' => 'EventAdminController@create',
        '/organizer/events/store' => 'EventAdminController@store',
        '/organizer/events/edit'   => 'EventAdminController@edit',
        '/organizer/events/update' => 'EventAdminController@update',
        '/organizer/events/delete' => 'EventAdminController@delete',


    ],

    'POST' => [
        //AUTH
        '/register' => 'AuthController@register',
        '/login' => 'AuthController@login',

        //EVENTS
        '/organizer/events/store' => 'EventAdminController@store',
        '/organizer/events/update' => 'EventAdminController@update',
        '/organizer/events/delete' => 'EventAdminController@delete',


    ]
];
