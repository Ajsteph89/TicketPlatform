<?php

return [
    'GET' => [
        '/' => 'TestController@index',

        //Auth
        '/register' => 'AuthController@showRegister',
        '/login' => 'AuthController@showLogin',
        '/logout' => 'AuthController@logout',

        //EVENT ORGANIZER
        //EVENTS
        '/organizer/events' => 'EventAdminController@index',
        '/organizer/events/create' => 'EventAdminController@create',
        '/organizer/events/store' => 'EventAdminController@store',
        '/organizer/events/edit'   => 'EventAdminController@edit',
        '/organizer/events/update' => 'EventAdminController@update',
        '/organizer/events/delete' => 'EventAdminController@delete',

        //TICKETS
        '/organizer/events/tickets'        => 'TicketAdminController@index',
        '/organizer/events/tickets/create' => 'TicketAdminController@create',
        '/organizer/events/tickets/edit' => 'TicketAdminController@edit',




    ],

    'POST' => [
        //AUTH
        '/register' => 'AuthController@register',
        '/login' => 'AuthController@login',

        //EVENT ORGANIZER
        //EVENTS
        '/organizer/events/store' => 'EventAdminController@store',
        '/organizer/events/update' => 'EventAdminController@update',
        '/organizer/events/delete' => 'EventAdminController@delete',

        //TICKETS
        '/organizer/events/tickets/store'  => 'TicketAdminController@store',
        '/organizer/events/tickets/update' => 'TicketAdminController@update',
        '/organizer/events/tickets/delete' => 'TicketAdminController@delete',




    ]
];
