<?php

namespace Core;

class Application
{
    protected Input $input;
    protected Output $output;
    protected CommandRegistry $commandRegistry;

    public function __construct()
    {
        $this->output = new Output();

        $this->commandRegistry = new CommandRegistry();
    }

    public function registerController($name, Command $controller): void
    {
        $this->commandRegistry->registerController($name, $controller);
    }

    public function registerCommand($name, $callable): void
    {
        $this->commandRegistry->registerCommand($name, $callable);
    }

    public function getOutput(): Output
    {
        return $this->output;
    }

    public function getCommand($command)
    {
        return $this->commandRegistry->getCommand($command);
    }

    public function runCommand(array $argv = []): void
    {
        $this->input = new Input($argv);

        try {
            call_user_func($this->commandRegistry->getCallable($this->input->getCommandName()), $argv);
        } catch (\Exception $e) {
            $this->getOutput()->write(["ERROR: " . $e->getMessage()]);
            exit;
        }
    }
}