<?php

if (PHP_SAPI !== 'cli' || PHP_VERSION < 7.4) {
    exit;
}

require __DIR__ . '/vendor/autoload.php';

use Core\Application;

$app = new Application();

$app->registerController('upskill', new UpSkill\UpSkillCommand($app));

$app->registerCommand('upskill', static function (array $argv) use ($app) {
    $name = $argv[2] ?? "World";
    $app->getOutput()->write(["Hello $name!!!"]);
});

try {
    $app->runCommand($argv);
} catch (Exception $e) {
    $app->getOutput()->writeln($e->getMessage());
}
