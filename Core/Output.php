<?php


namespace Core;


class Output
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