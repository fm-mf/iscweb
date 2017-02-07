<?php
return [
    'roles' => [
        'supervisor' => [
            'id' => 1,
            'resources' => [
                'partaknet',
                'users' => ['view', 'edit'],
                'trips',
            ],
            'inheritsFrom' => []
        ],

        'partak' => [
            'id' => 2,
            'resources' => [
                'partaknet',
            ],
            'inheritsFrom' => []
        ],
    ]
];