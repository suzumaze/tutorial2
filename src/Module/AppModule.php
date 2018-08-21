<?php
namespace MyVendor\Ticket\Module;

use BEAR\Package\AbstractAppModule;
use BEAR\Package\PackageModule;
use josegonzalez\Dotenv\Loader;

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
        $this->install(new PackageModule);
    }
}
