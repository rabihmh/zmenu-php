<?php
return [
    [
        'route' => '#',
        'icon' => 'fas fa-fw fa-tachometer-alt',
        'label' => 'Dashboard'
    ],
    [
        'route' => '#',
        'icon' => 'fas fa-fw fa-table',
        'label' => 'Table',
        'submenu' => [
            ['url' => '#', 'label' => 'index 1'],
            ['url' => '#', 'label' => 'index 2'],
            ['url' => '#', 'label' => 'index 3'],
        ]
    ],
    [
        'route' => '#',
        'icon' => 'fas fa-fw fa-table',
        'label' => 'Order',
        'submenu' => [
            ['url' => '#', 'label' => 'index 1'],
            ['url' => '#', 'label' => 'index 2'],
            ['url' => '#', 'label' => 'index 3'],
        ]
    ],
    [
        'route' => '#',
        'icon' => 'fas fa-fw fa-restaurant',
        'label' => 'Restaurant',
        'submenu' => [
            ['url' => '#', 'label' => 'index 1'],
            ['url' => '#', 'label' => 'index 2'],
            ['url' => '#', 'label' => 'index 3'],
        ]
    ]

];
