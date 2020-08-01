<?php


namespace Core;


abstract class Command
{
    protected Application $app;

    abstract public function execute();

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    protected function getApplication(): Application
    {
        return $this->app;
    }
}