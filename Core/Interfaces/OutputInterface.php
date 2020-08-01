<?php


namespace Core\Interfaces;


interface OutputInterface
{
    public function write(array $messageCollection): void;
    public function writeln(string $message): void;
}