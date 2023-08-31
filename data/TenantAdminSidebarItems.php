<?php
return [
    [
        'route' => 'tenant.admin.home',
        'icon' => 'fas fa-fw fa-tachometer-alt',
        'label' => 'Dashboard'
    ],
    [
        'icon' => 'fas fa-fw fa-table',
        'label' => 'Categories',
        'submenu' => [
            ['url' => 'tenant.admin.categories.index', 'label' => 'index'],
            ['url' => 'tenant.admin.categories.create', 'label' => 'Create'],
        ]
    ],

];
