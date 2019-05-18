<?php // File location: /wp-content/themes/your-theme/
require __DIR__.'/../../../vendor/autoload.php'; // include composer inside Wordpress
/*
 * Configure Eloquent (called Capsule when used alone)
 */

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => DB_HOST,
    'database'  => DB_NAME,
    'username'  => DB_USER,
    'password'  => DB_PASSWORD,
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
$capsule->setEventDispatcher(new \Illuminate\Events\Dispatcher(new \Illuminate\Container\Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();
