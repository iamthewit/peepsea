<?php
require_once __DIR__ . '/../vendor/autoload.php';

fwrite(STDOUT, \Ramsey\Uuid\Uuid::uuid4() . "\r\n");