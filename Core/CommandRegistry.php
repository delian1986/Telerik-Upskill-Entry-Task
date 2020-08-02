<?php


namespace Core;


class CommandRegistry
{
    protected array $registry = [];

    public function registerCommand(string $name, string $className): void
    {
        $this->registry[$name] = $className;
    }

    public function getCommand($command)
    {
        return $this->registry[$command] ?? null;
    }
}