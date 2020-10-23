<?php

return [
    /*
     * How long time in minutes should the verification code be valid for
     */
    'link_expires_in_minutes' => 300,

    /*
     * How long time in minutes should the user be verified for the certain route
     */
    'validation_expires_after_minutes' => 30,

    /*
     * Should be use the queue to sent out the verification email
     */
    'use_queue' => false,

    /*
     * Route Prefix
     */
    'route_prefix' => '',

    /*
     * Route Middleware
     */
    'route_middleware' => [],
];
