<?php

use Application\API\HomeController;
use Application\API\PeepSeaController;
use DI\Bridge\Slim\Bridge;

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../config/debug.php';
$container = include __DIR__ . '/../config/container.php';

// Create Application
$app = Bridge::create($container);

/**
 * ROUTING
 */
// HomeController
$app->get('/', [HomeController::class, 'index']);

// PeepSeaController
$app->get('/peepsea', [PeepSeaController::class, 'list']);
$app->post('/peepsea', [PeepSeaController::class, 'create']);
$app->get('/peepsea/{id}', [PeepSeaController::class, 'show']);
$app->put('/peepsea/{id}', [PeepSeaController::class, 'update']);
$app->delete('/peepsea/{id}', [PeepSeaController::class, 'delete']);

// Run the Application
try {
    $app->run();
} catch (Exception $e) {
    // TODO: add an exception handler
    !d($e);
}