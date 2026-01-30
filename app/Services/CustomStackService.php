<?php

namespace App\Services;

use Exception;

class CustomStack
{
    private array $list = [];

    public function count(): int
    {
        return count($this->list);
    }

    public function push(int $value): void
    {
        $this->list[] = $value;
    }

    public function pop(): int
    {
        if ($this->count() === 0) {
            throw new StackCantBeEmptyException("Can't call Pop on an empty stack.");
        }

        $popped = end($this->list);
        array_pop($this->list);

        return $popped;
    }
}

class StackCantBeEmptyException extends Exception
{
}
