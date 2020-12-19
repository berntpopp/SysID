<?php
return [
    'browse' => [
        'type' => 2,
        'description' => 'Browse',
    ],
    'edit' => [
        'type' => 2,
        'description' => 'Edit',
    ],
    'manage' => [
        'type' => 2,
        'description' => 'Manage',
    ],
    'user' => [
        'type' => 1,
        'children' => [
            'browse',
        ],
    ],
    'editor' => [
        'type' => 1,
        'children' => [
            'edit',
            'user',
        ],
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'manage',
            'editor',
        ],
    ],
];
