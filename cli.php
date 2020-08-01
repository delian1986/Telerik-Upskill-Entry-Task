<?php

if (PHP_SAPI !== 'cli' || PHP_VERSION < 7.4) {
    exit;
}

require __DIR__ . '/vendor/autoload.php';

use Core\Application;

$app = new Application($argv);

$app->registerCommands([
    'upskill' => \UpSkill\UpSkillCommand::class
]);

try {
    $app->runCommand();
} catch (Exception $e) {
    $app->getOutput()->writeln($e->getMessage());
}
