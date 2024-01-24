<?php
return [
    'roles' => [

        'exchange_student' => [
            'id' => 6,
            'inheritsFrom' => [],
            'resources' => [],
        ],

        'samoplatce' => [
            'id' => 9,
            'inheritsFrom' => [],
            'resources' => [],
        ],

        'buddy' => [
            'id' => 3,
            'inheritsFrom' => [],
            'resources' => [],
        ],

        'partak' => [
            'id' => 2,
            'inheritsFrom' => ['buddy'],
            'resources' => [
                'partaknet',
            ],
        ],

        'author' => [
            'id' => 8,
            'inheritsFrom' => ['partak'],
            'resources' => [],
        ],

        'point' => [
            'id' => 11,
            'inheritsFrom' => ['partak'],
            'resources' => [
                'exchangeStudents' => ['view', 'add', 'edit', 'register'],
                'trips' => ['view', 'view_payment'],
                'participant' => ['add', 'remove'],
                'users' => ['view'],
                'products' => ['view'],
                'productSales' => ['view', 'add'],
            ],
        ],

        'buddyManager' => [
            'id' => 10,
            'inheritsFrom' => ['partak'],
            'resources' => [
                'buddy' => ['view', 'edit', 'remove', 'verify'],
                'users' => ['view'],
                'exchangeStudents' => ['view'],
                'roles' => ['view', 'partak', 'samoplatce'],
                'stats' => ['view', 'export_buddy'],
            ],
        ],

        'team' => [
            'id' => 4,
            'inheritsFrom' => ['point'],
            'resources' => [
                'trips' => ['add', 'edit'],
                'buddy' => ['view', 'edit', 'remove'],
                'roles' => ['view', 'partak', 'point'],
                'events' => ['view', 'add', 'edit'],
                'stats' => ['view'],
                'settings' => ['openingHours'],
            ],
        ],

        'integreatCoordinator' => [
            'id' => 13,
            'inheritsFrom' => ['team'],
            'resources' => [
                'votingResults' => ['view'],
                'stats' => ['export_ce'],
            ],
        ],

        'board' => [
            'id' => 5,
            'inheritsFrom' => ['buddyManager', 'team'],
            'resources' => [
                'details' => ['view'],
                'events' => ['remove'],
                'trips' => ['remove'],
                'quarantined',
                'products' => ['add', 'edit', 'remove'],
            ],
        ],

        'hr' => [
            'id' => 12,
            'inheritsFrom' => ['board'],
            'resources' => [
                'roles' => ['team', 'buddyManager', 'integreatCoordinator', 'hr']
            ],
        ],

        'admin' => [
            'id' => 7,
            'inheritsFrom' => ['hr', 'integreatCoordinator'],
            'resources' => [
                'users' => ['import'],
                'roles' => ['board', 'admin'],
                'settings' => ['edit'],
                'alumniNewsletter' => ['create', 'update', 'delete'],
            ],
        ],

        'supervisor' => [
            'id' => 1,
            'inheritsFrom' => ['admin'],
            'resources' => [
                'roles' => ['all'],
                'logs',
            ],
        ],
    ],
];
