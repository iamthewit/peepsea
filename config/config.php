<?php

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../.env');
$dotenv->load();

return [
    'database_host' => getenv('DATABASE_HOST'),
    'kint_enabled' => getenv('KINT_ENABLED'),
];