<?php

namespace UpSkill;

use Core\Application;
use Core\Command;
use Core\Interfaces\InputInterface;
use Core\Interfaces\OutputInterface;

class UpSkillCommand extends Command
{
    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        var_dump($input->getParams());
    }
}