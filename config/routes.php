<?php

return [
    'GET' => [
        //HOMEPAGE
        '/' => 'HomeController@index',

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

        //PUBLIC EVENTS 
        '/events' => 'Goer/EventController@index',
        '/events/show' => 'Goer/EventController@show',

        //CART + CHECKOUT
        '/cart' => 'Cart/CartController@index',
        '/checkout' => 'Cart/CheckoutController@index',
        '/checkout/success' => 'Cart/CheckoutController@success',

        '/my-tickets' => 'Goer/TicketController@myTickets',
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

        //CART + CHECKOUT
        '/cart/add'    => 'Cart/CartController@add',
        '/cart/remove' => 'Cart/CartController@remove',
        '/cart/clear'  => 'Cart/CartController@clear',
        '/checkout/process' => 'Cart/CheckoutController@process',



    ]
];
