<?php

require __DIR__ . '/../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

//Loading Environmental variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

$capsule->addConnection([

   "driver" => $_ENV['DB_DRIVER'],

   "host" => $_ENV['DB_HOST'],

   "database" => $_ENV['DB_NAME'],

   "username" => $_ENV['DB_USER'],

   "password" => $_ENV['DB_PASSWORD']

]);

//Make this Capsule instance available globally.
$capsule->setAsGlobal();

// Setup the Eloquent ORM.
$capsule->bootEloquent();
$capsule->bootEloquent();