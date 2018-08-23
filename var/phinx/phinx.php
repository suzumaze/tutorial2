<?php
$pdo = new \PDO(getenv('TKT_DB_DSN'), getenv('TKT_DB_USER'), getenv('TKT_DB_PASS'));
$name = $pdo->query("SELECT DATABASE()")->fetchColumn();
return [
    'paths' => [
        'migrations' => __DIR__ . '/migrations',
    ],
    'environments' => [
        'development' => [
            'name' => $name,
            'connection' => $pdo
        ],
        'test' => [
            'name' => $name . '_test',
            'connection' => $pdo
        ]
    ]
];
