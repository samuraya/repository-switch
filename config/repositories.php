<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

use App\Repositories\ShirtOrderRepositoryInterface;
use App\Repositories\Cache\CacheShirtOrderRepository;
use Illuminate\Database\Capsule\Manager as Capsule;



return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        ShirtOrderRepositoryInterface::class => \DI\autowire(CacheShirtOrderRepository::class),

        Capsule::class=>function(ContainerInterface $c) {
            $dbSettings=$c->get('settings')['db'];

            $capsule = new Capsule;

            $capsule->addConnection([

               "driver" => $dbSettings['driver'],

               "host" => $dbSettings['host'],

               "database" => $dbSettings['dbname'],

               "username" => $dbSettings['user'],

               "password" => $dbSettings['password']

            ]);               

            return $capsule;
        }       
        
    ]);
};
