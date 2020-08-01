<?php

namespace UpSkill;

use Core\Command;

class UpSkillCommand extends Command
{
    public function execute($argv)
    {
        $name = $argv[2] ?? "World";
        $this->getApplication()->getOutput()->write(["Hello $name!!!"]);
    }
}