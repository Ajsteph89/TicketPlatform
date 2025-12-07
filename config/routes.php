<?php

return [
    'GET' => [
        '/' => 'TestController@index',

        '/register' => 'AuthController@showRegister',
        '/login' => 'AuthController@showLogin',
        '/logout' => 'AuthController@logout',

           // ✅ TEMP organizer landing page
        '/organizer/events' => 'OrganizerController@index',
    ],

    'POST' => [
        '/register' => 'AuthController@register',
        '/login' => 'AuthController@login',
    ]
];
