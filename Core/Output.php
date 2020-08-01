<?php


namespace Core;


use Core\Interfaces\OutputInterface;

class Output implements OutputInterface
{
    public function write(array $messageCollection): void
    {
        echo implode(PHP_EOL, $messageCollection);
    }

    public function writeln(string $message): void
    {
        echo $message . PHP_EOL;
    }
}