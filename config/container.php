<?php
/**
 * CONTAINER
 */

use Psr\Container\ContainerInterface;
use Repository\PeepSeaRepositoryInterface;
use Repository\SQLPeepSeaRepository;

$config = include __DIR__ . '/../config/config.php';

$builder = new DI\ContainerBuilder();

// Set Config Values
$builder->addDefinitions($config);

// ASet DB and Repositories
$builder->addDefinitions([
    PDO::class => function(ContainerInterface $c) {
        return new PDO($c->get('database_host'));
    },
    PeepSeaRepositoryInterface::class => function(ContainerInterface $c) {
        return new SQLPeepSeaRepository($c->get(PDO::class));
    }
]);

return $builder->build();