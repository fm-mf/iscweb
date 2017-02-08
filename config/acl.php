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
                'roles',    //zatim jenom v buddies edit formu
            ],
            'inheritsFrom' => ['partak']
        ],

        'team' => [
            'id' => 4,
            'resources' => [
                'trips' => ['edit', 'add'],
            ],
            'inheritsFrom' => ['point']
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
            ],
            'inheritsFrom' => ['board']
        ],


        'admin' => [
            'id' => 7,
            'resources' => [
                //'roles'
            ],
            'inheritsFrom' => ['hr']
        ],

        'supervisor' => [
            'id' => 1,
            'resources' => [
                'trips' => ['remove'],
                'roles',
            ],
            'inheritsFrom' => ['admin']
        ],


    ]
];