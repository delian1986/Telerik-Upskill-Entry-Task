<?php


namespace Core\Interfaces;


interface InputInterface
{
    public function getParams(): ?string;

    public function getCommandName(): ?string;
}