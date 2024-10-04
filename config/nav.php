<?php


return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'title' => 'Starter Pages',
        'route' => 'dashboard.dashboard',
        
    ],

    [
        'icon' => 'far fa-circle nav-icon',
        'title' => 'categories',
        'route' => 'dashboard.categories.index',
        'ability'=> 'categories.view'
    ],

    [
        'icon' => 'far fa-circle nav-icon',
        'title' => 'products',
        'route' => 'dashboard.products.index',
        'ability'=> 'products.view'
    ],

    [
        'icon' => 'far fa-shield nav-icon',
        'title' => 'roles',
        'route' => 'dashboard.roles.index',
        // 'ability'=> 'products.view'
    ],

  
];
