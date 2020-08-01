<?php

namespace Core;

use Core\Exception\CommandNotFoundException;
use Core\Exception\WrongCommandInstance;
use Core\Http\ContentApi;
use Core\Http\Curl;

class Application
{
    private Input $input;
    private Output $output;
    private ContentApi $contentApi;
    private CommandRegistry $commandRegistry;

    public function __construct(array $argv = [])
    {
        $this->contentApi = new ContentApi(new Curl());
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

    public function getContentApi():ContentApi
    {
        return $this->contentApi;
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
            throw new WrongCommandInstance('Command: "'.$this->input->getCommandName().'" must be instance of Core\Command');
        }

        return $command->execute();
    }
}