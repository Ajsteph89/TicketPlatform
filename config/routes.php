<?php

return [
    'GET' => [
        '/' => 'Goer/EventController@index',

        //AUTH
        '/register' => 'AuthController@showRegister',
        '/login' => 'AuthController@showLogin',
        '/logout' => 'AuthController@logout',

        //ORGANIZER - EVENTS
        '/organizer/events' => 'Organizer/EventAdminController@index',
        '/organizer/events/create' => 'Organizer/EventAdminController@create',
        '/organizer/events/edit'   => 'Organizer/EventAdminController@edit',

        //ORGANIZER - TICKETS
        '/organizer/events/tickets'        => 'Organizer/TicketAdminController@index',
        '/organizer/events/tickets/create' => 'Organizer/TicketAdminController@create',
        '/organizer/events/tickets/edit' => 'Organizer/TicketAdminController@edit',

        //EVENT GOER
        '/events/show' => 'Goer/EventController@show',

        //CART
        '/cart' => 'Cart/CartController@index',



    ],

    'POST' => [
        //AUTH
        '/register' => 'AuthController@register',
        '/login' => 'AuthController@login',

        //ORGANIZER -EVENTS
        '/organizer/events/store' => 'Organizer/EventAdminController@store',
        '/organizer/events/update' => 'Organizer/EventAdminController@update',
        '/organizer/events/delete' => 'Organizer/EventAdminController@delete',

        //ORGANIZER - TICKETS
        '/organizer/events/tickets/store'  => 'Organizer/TicketAdminController@store',
        '/organizer/events/tickets/update' => 'Organizer/TicketAdminController@update',
        '/organizer/events/tickets/delete' => 'Organizer/TicketAdminController@delete',

        //CART
        '/cart/add'    => 'Cart/CartController@add',
        '/cart/remove' => 'Cart/CartController@remove',
        '/cart/clear'  => 'Cart/CartController@clear',



    ]
];
