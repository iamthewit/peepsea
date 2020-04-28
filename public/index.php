<?php

use Application\API\PeepSeaController;
use DI\Bridge\Slim\Bridge;
use Repository\PeepSeaRepositoryInterface;
use Repository\SQLPeepSeaRepository;

require __DIR__ . '/../vendor/autoload.php';

$config = include __DIR__ . '/../config/config.php';

// TODO: turn kint off in prod environment
Kint\Renderer\RichRenderer::$theme = 'solarized-dark.css';

$pdo = new PDO($config['database_host']);

// TODO: move container code
$builder = new DI\ContainerBuilder();
$builder->addDefinitions([
   PeepSeaRepositoryInterface::class => new SQLPeepSeaRepository($pdo)
]);
$container = $builder->build();
$app = Bridge::create($container);

// TODO: move routing code
$app->get('/', [PeepSeaController::class, 'list']);
$app->get('/peepsea/{id}', [PeepSeaController::class, 'show']);
$app->post('/peepsea', [PeepSeaController::class, 'create']);

try {
    $app->run();
} catch (Exception $e) {
    // TODO: add an exception handler
    !d($e);
}