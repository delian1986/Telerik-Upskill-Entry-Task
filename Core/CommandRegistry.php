<?php


namespace Core;


class CommandRegistry
{
    protected array $registry = [];

    protected array $controllers = [];

    public function registerController($commandName, Command $controller): void
    {
        $this->controllers = [ $commandName => $controller ];
    }

    public function registerCommand($name, $callable): void
    {
        $this->registry[$name] = $callable;
    }

    public function getController($command)
    {
        return $this->controllers[$command] ?? null;
    }

    public function getCommand($command)
    {
        return $this->registry[$command] ?? null;
    }

    public function getCallable($commandName)
    {
        $controller = $this->getController($commandName);

        if ($controller instanceof Command) {
            return [ $controller, 'execute' ];
        }

        $command = $this->getCommand($commandName);
        if ($command === null) {
            throw new \CommandNotFoundException("Command \"$commandName\" not found.");
        }

        return $command;
    }
}