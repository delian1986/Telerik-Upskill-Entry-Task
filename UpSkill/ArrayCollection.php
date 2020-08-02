<?php


namespace UpSkill;


class ArrayCollection implements ArrayCollectionInterface
{
    private array $collection;

    public function __construct()
    {
        $this->collection = [];
    }

    public function add(array $collection): void
    {
        foreach ($collection as $item) {
            $this->collection[] = $item['Title'];
        }
    }

    public function sort(): void
    {
        sort($this->collection);
    }

    public function get(): array
    {
        return $this->collection;
    }
}