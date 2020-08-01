<?php


namespace Core;


use Core\Interfaces\InputInterface;

class Input implements InputInterface
{
    private ?string $commandName;
    private ?string $inputParam;

    public function __construct(array $argv)
    {
        $this->commandName = $argv[1] ?? null;
        $this->inputParam = $argv[2] ?? null;
    }

    public function getParams(): ?string
    {
        return $this->inputParam;
    }

    public function getCommandName(): ?string
    {
        return $this->commandName;
    }
}