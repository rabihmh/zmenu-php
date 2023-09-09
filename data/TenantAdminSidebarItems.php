<?php
return [
    [
        'route' => 'tenant.admin.home',
        'icon' => 'fas fa-fw fa-tachometer-alt',
        'label' => 'Dashboard'
    ],
    [
        'route' => 'tenant.admin.restaurant.show',
        'icon' => 'fas fa-fw fa-shopping-bag',
        'label' => 'Restaurant'
    ],
    [
        'icon' => 'fas fa-fw fa-table',
        'label' => 'Categories',
        'submenu' => [
            ['url' => 'tenant.admin.categories.index', 'label' => 'index'],
            ['url' => 'tenant.admin.categories.create', 'label' => 'Create'],
        ]
    ],
    [
        'icon' => 'fas fa-fw fa-wrench',
        'label' => 'Products',
        'submenu' => [
            ['url' => 'tenant.admin.products.index', 'label' => 'index'],
            ['url' => 'tenant.admin.products.create', 'label' => 'Create'],
        ]
    ],
    [
        'icon' => 'fas fa-fw fa-table',
        'label' => 'Tables',
        'submenu' => [
            ['url' => 'tenant.admin.tables.index', 'label' => 'index'],
            ['url' => 'tenant.admin.tables.create', 'label' => 'Create'],
        ]
    ],

];
