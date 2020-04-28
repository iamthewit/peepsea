<?php
/**
 * DEBUGGING
 */

$config = include __DIR__ . '/../config/config.php';

Kint::$enabled_mode = $config['kint_enabled'];
Kint\Renderer\RichRenderer::$theme = 'solarized-dark.css';