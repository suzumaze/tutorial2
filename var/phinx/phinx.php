<?php
(new josegonzalez\Dotenv\Loader(dirname(__DIR__, 2) . '/.env'))->parse()->toEnv();
$pdo = new PDO('mysql:', getenv('TICKET_DB_USER'), getenv('TICKET_DB_PASS'));
return [
    'paths' => [
        'migrations' => __DIR__ . '/migrations',
    ],
    'environments' => [
        'development' => [
            'name' => getenv('TICKET_DB_NAME'),
            'connection' => $pdo
        ],
        'test' => [
            'name' => getenv('TICKET_DB_NAME') . '_test',
            'connection' => $pdo
        ]
    ]
];

