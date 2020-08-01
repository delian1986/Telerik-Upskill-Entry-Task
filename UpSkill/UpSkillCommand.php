<?php

namespace UpSkill;

use Core\Command;

class UpSkillCommand extends Command
{
    public function execute()
    {
        $this->getApplication()->getOutput()->writeln(123);
    }
}