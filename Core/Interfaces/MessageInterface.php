<?php

namespace Core\Interfaces;

interface MessageInterface
{
    public function getHeaders();

    public function getBody();
}