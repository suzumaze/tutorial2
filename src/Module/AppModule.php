<?php
namespace MyVendor\Ticket\Module;

use BEAR\Package\AbstractAppModule;
use BEAR\Package\PackageModule;
use BEAR\Resource\Module\JsonSchemaModule;
use josegonzalez\Dotenv\Loader;
use Ray\AuraSqlModule\AuraSqlModule;
use Ray\IdentityValueModule\IdentityValueModule;
use Ray\Query\SqlQueryModule;

class AppModule extends AbstractAppModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $env = $this->appMeta->appDir . '/.env';
        if (file_exists($env)) {
            (new Loader($env))->parse()->toEnv(true);
        }
        $this->install(new AuraSqlModule(
            getenv('TICKET_DB_DSN'),
            getenv('TICKET_DB_USER'),
            getenv('TICKET_DB_PASS'),
            getenv('TICKET_DB_SLAVE')
        ));
        $varDir = $this->appMeta->appDir . '/var';
        $this->install(new SqlQueryModule($varDir . '/sql'));
        $this->install(new IdentityValueModule);
        $this->install(new JsonSchemaModule($varDir . '/json_schema', $varDir . '/json_validate'));
        $this->install(new PackageModule);
        $this->install(new PackageModule);
    }
}
