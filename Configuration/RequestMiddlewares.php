<?php

return [
    'frontend' => [
        'simulatebe/backend-user-simulator' => [
            'target' => \Cabag\Simulatebe\Middleware\BackendUserSimulator::class,
            'after' => [
                'typo3/cms-frontend/tsfe'
            ],
        ],
    ],
];
