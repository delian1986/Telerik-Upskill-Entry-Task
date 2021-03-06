<?php

namespace Core;

use Core\Exception\CommandNotFoundException;
use Core\Exception\WrongCommandInstance;
use Core\Http\ContentApi;
use Core\Http\Curl;
use Core\Interfaces\InputInterface;
use Core\Interfaces\OutputInterface;

class Application
{
    private InputInterface $input;
    private OutputInterface $output;
    private ContentApi $contentApi;
    private CommandRegistry $commandRegistry;

    public function __construct(array $argv = [])
    {
        $this->contentApi = new ContentApi(new Curl());
        $this->output = new Output();
        $this->input = new Input($argv);
        $this->commandRegistry = new CommandRegistry();
    }

    public function getContentApi(): ContentApi
    {
        return $this->contentApi;
    }

    public function registerCommands(array $commands): void
    {
        foreach ($commands as $name => $class){
            $this->commandRegistry->registerCommand($name, $class);
        }
    }

    public function getOutput(): OutputInterface
    {
        return $this->output;
    }

    public function getInput(): InputInterface
    {
        return $this->input;
    }

    /**
     * @throws CommandNotFoundException
     * @throws WrongCommandInstance
     */
    public function runCommand(): int
    {
        $command = $this->commandRegistry->getCommand($this->input->getCommandName());

        if ($command === null) {
            throw new CommandNotFoundException('Command: "'.$this->input->getCommandName().'" not found.');
        }

        $command = new $command($this);

        if (!$command instanceof Command) {
            throw new WrongCommandInstance('Command: "'.$this->input->getCommandName().'" must be instance of Core\Command');
        }

        return $command->execute($this->getInput(), $this->getOutput());
    }
}