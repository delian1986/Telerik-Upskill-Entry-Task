<?php


namespace Core;


use Core\Interfaces\InputInterface;
use Core\Interfaces\OutputInterface;

abstract class Command
{
    protected Application $app;

    abstract public function execute(InputInterface $input, OutputInterface $output);

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    protected function getApplication(): Application
    {
        return $this->app;
    }
}