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
                'trips' => ['view'],
                'participant' => ['add', 'remove'],
                'exchangeStudents' => ['register', 'add', 'view'],
            ],
            'inheritsFrom' => ['partak']
        ],

        'buddyManager' => [
            'id' => 10,
            'resources' => [
                'buddy' => ['view', 'edit', 'remove'],
                'exchangeStudents' => ['register', 'add', 'view']
            ],
            'inheritsFrom' => ['partak']
        ],

        'team' => [
            'id' => 4,
            'resources' => [
                'users' => ['view'],
            ],
            'inheritsFrom' => ['partak', 'point']
        ],

        'board' => [
            'id' => 5,
            'resources' => [
                'users' => ['edit'],
            ],
            'inheritsFrom' => ['buddyManager', 'team']
        ],

        'admin' => [
            'id' => 7,
            'resources' => [

            ],
            'inheritsFrom' => ['board', 'author']
        ],

        'supervisor' => [
            'id' => 1,
            'resources' => [
                'partaknet',
                'users' => ['view', 'edit'],
                'trips',
            ],
            'inheritsFrom' => ['admin']
        ],


    ]
];