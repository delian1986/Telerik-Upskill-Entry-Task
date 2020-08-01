<?php

if (PHP_SAPI !== 'cli' || PHP_VERSION < 7.4) {
    exit;
}

require __DIR__ . '/vendor/autoload.php';

use Core\Application;

$app = new Application();

$app->runCommand($argv);
