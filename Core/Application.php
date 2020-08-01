<?php

namespace Core;

use Core\Exception\CommandNotFoundException;
use Core\Exception\WrongCommandInstance;

class Application
{
    protected Input $input;
    protected Output $output;
    protected CommandRegistry $commandRegistry;

    public function __construct(array $argv = [])
    {
        $this->output = new Output();

        $this->input = new Input($argv);

        $this->commandRegistry = new CommandRegistry();
    }

    public function registerCommands(array $commands): void
    {
        foreach ($commands as $name => $class){
            $this->commandRegistry->registerCommand($name, $class);
        }
    }

    public function getOutput(): Output
    {
        return $this->output;
    }

    /**
     * @throws CommandNotFoundException
     * @throws WrongCommandInstance
     */
    public function runCommand()
    {
        $command = $this->commandRegistry->getCommand($this->input->getCommandName());

        if ($command === null) {
            throw new CommandNotFoundException('Command: "'.$this->input->getCommandName().'" not found.');
        }

        $command = new $command($this);

        if (!$command instanceof Command) {
            throw new WrongCommandInstance('Command: "'.$this->input->getCommandName().'"must be instance of Command');
        }

        return $command->execute();
    }
}