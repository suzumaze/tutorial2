<?php
use Aura\Sql\ExtendedPdoInterface;
use MyVendor\Ticket\Module\AppModule;
use Ray\Di\Injector;

$pdo = (new Injector(new AppModule))->getInstance(ExtendedPdoInterface::class);
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

