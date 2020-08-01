<?php

namespace Core;

class Application
{
    public function runCommand(array $argv): void
    {
        $name = $argv[1] ?? 'World';

        echo 123;
    }
}