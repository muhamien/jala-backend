<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [ 
        'admin' => [
            'users' => 'c,r,u,d',
            'products' => 'c,r,u,d',
            'category_products' => 'c,r,u,d',
            'orders' => 'c,r,u,d',
            'order_details' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'user' => [
            'products' => 'r',
            'orders' => 'c,r',
            'order_details' => 'c,r,u',
            'profile' => 'r,u',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
