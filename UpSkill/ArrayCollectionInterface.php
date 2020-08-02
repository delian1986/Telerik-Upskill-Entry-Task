<?php


namespace UpSkill;


interface ArrayCollectionInterface
{
    public function add(array $collection): void;

    public function sort(array $collection): void;
}