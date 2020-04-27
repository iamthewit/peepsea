<?php

use Application\API\PeepSeaController;
use DI\Bridge\Slim\Bridge;
use Repository\PeepSeaRepositoryInterface;
use Repository\SQLPeepSeaRepository;

require __DIR__ . '/../vendor/autoload.php';

$config = include __DIR__ . '/../config/config.php';

$pdo = new PDO($config['database_host']);

$builder = new DI\ContainerBuilder();
$builder->addDefinitions([
   PeepSeaRepositoryInterface::class => new SQLPeepSeaRepository($pdo)
]);
$container = $builder->build();
$app = Bridge::create($container);

$app->get('/', [PeepSeaController::class, 'list']);
$app->get('/peepsea/{id}', [PeepSeaController::class, 'show']);
$app->post('/peepsea', [PeepSeaController::class, 'create']);

$app->run();