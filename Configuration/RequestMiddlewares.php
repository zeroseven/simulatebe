<?php

return [
    'frontend' => [
        'simulatebe/backend-user-simulator' => [
            'target' => \Cabag\Simulatebe\Middleware\BackendUserSimulator::class,
            'before' => [
                'typo3/cms-frontend/backend-user-authentication'
            ],
            'after' => [
                'typo3/cms-frontend/authentication'
            ],
        ],
    ],
];
