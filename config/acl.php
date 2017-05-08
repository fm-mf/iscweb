<?php
return [
    'roles' => [

        'exchange_student' => [
            'id' => 6,
            'resources' => [],
            'inheritsFrom' => []
        ],

        'samoplatce' => [
            'id' => 9,
            'resources' => [],
            'inheritsFrom' => []
        ],

        'buddy' => [
            'id' => 3,
            'resources' => [],
            'inheritsFrom' => []
        ],

        'partak' => [
            'id' => 2,
            'resources' => [
                'partaknet',
            ],
            'inheritsFrom' => ['buddy']
        ],

        'author' => [
            'id' => 8,
            'resources' => [],
            'inheritsFrom' => ['partak']
        ],

        'point' => [
            'id' => 11,
            'resources' => [
                'trips' => ['view', 'view_payment'],
                'participant' => ['add', 'remove'],
                'users' => ['view'],
                'exchangeStudents' => ['register', 'add', 'view', 'edit'],
            ],
            'inheritsFrom' => ['partak']
        ],

        'buddyManager' => [
            'id' => 10,
            'resources' => [
                'buddy' => ['view', 'edit', 'remove'],
                'users' => ['view'],
                'exchangeStudents' => ['view'],
                'roles' => ['view', 'partak', 'samoplatce']
            ],
            'inheritsFrom' => ['partak']
        ],

        'team' => [
            'id' => 4,
            'resources' => [
                'trips' => ['edit', 'add'],
                'buddy' => ['view', 'edit', 'remove'],
                'roles' => ['view', 'partak'],
                'events' => ['edit', 'add', 'view'],
            ],
            'inheritsFrom' => ['point']
        ],

        'integreatCoordinator' => [
            'id' => 13,
            'resources' => [
                'votingResults' => ['view'],
            ],
            'inheritsFrom' => ['team']
        ],
        
        'board' => [
            'id' => 5,
            'resources' => [
                'users' => ['edit'],
            ],
            'inheritsFrom' => ['buddyManager', 'team']
        ],

        'hr' => [
            'id' => 12,
            'resources' => [
                'buddy' => ['verify'],
                'roles' => ['view', 'partak', 'buddyManager', 'point'],
            ],
            'inheritsFrom' => ['board']
        ],


        'admin' => [
            'id' => 7,
            'resources' => [
                'roles' => ['view', 'partak', 'buddyManager', 'board', 'hr', 'team', 'integreatCoordinator'],
                'settings' => ['edit'],
                'details' => ['view'],
                'votingResults' => ['view'],
            ],
            'inheritsFrom' => ['hr']
        ],

        'supervisor' => [
            'id' => 1,
            'resources' => [
                'trips' => ['remove'],
                'roles' => ['view', 'all'],
            ],
            'inheritsFrom' => ['admin']
        ],
    ],
];