<?php
require dirname(__DIR__) . '/vendor/autoload.php';
// dir
chdir(dirname(__DIR__));
passthru('rm -rf var/tmp/*');
passthru('chmod 775 var/tmp');
passthru('chmod 775 var/log');
// db
(new josegonzalez\Dotenv\Loader(dirname(__DIR__) . '/.env'))->parse()->toEnv();
$db = new PDO('mysql:', getenv('TICKET_DB_USER'), getenv('TICKET_DB_PASS'));
$db->exec('CREATE DATABASE IF NOT EXISTS ' . getenv('TICKET_DB_NAME'));
$db->exec('CREATE DATABASE IF NOT EXISTS ' . getenv('TICKET_DB_NAME') . '_test');
passthru('./vendor/bin/phinx migrate -c var/phinx/phinx.php -e development');
