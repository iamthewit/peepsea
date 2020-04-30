<?php
require __DIR__ . '/../vendor/autoload.php';
$config = include __DIR__ . '/../config/config.php';
$migrations = file_get_contents(__DIR__ . '/../database/migrations.sql');

$pdo = new PDO($config['database_host']);
$pdo->exec($migrations);

