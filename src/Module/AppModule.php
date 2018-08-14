<?php
namespace MyVendor\Ticket\Module;

use BEAR\Package\PackageModule;
use BEAR\Resource\Module\JsonSchemaModule;
use josegonzalez\Dotenv\Loader;
use Ray\AuraSqlModule\AuraSqlModule;
use Ray\Di\AbstractModule;
use Ray\IdentityValueModule\IdentityValueModule;
use Ray\Query\SqlQueryModule;

class AppModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $appDir = dirname(__DIR__, 2);
        (new Loader($appDir . '/.env'))->parse()->toEnv(true);
        $this->install(new AuraSqlModule($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_SLAVE']));
        $this->install(new SqlQueryModule($appDir . '/var/sql'));
        $this->install(new IdentityValueModule);
        $this->install(new JsonSchemaModule($appDir . '/var/json_schema', $appDir . '/var/json_validate'));
        $this->install(new PackageModule);
    }
}
