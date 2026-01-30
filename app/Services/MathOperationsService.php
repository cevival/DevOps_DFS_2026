<?php

namespace App\Services;

use InvalidArgumentException;

class MathOperationsService
{
    public function add(int $numberOne, int $numberTwo): int
    {
        return $numberOne + $numberTwo;
    }

    public function divide(int $numberOne, int $numberTwo): float
    {
        if ($numberTwo === 0) {
            throw new InvalidArgumentException("Second parameter can't be equal to zero");
        }

        return $numberOne / $numberTwo;
    }

    public function getOddNumbers(int $limit): array
    {
        if ($limit < 0) {
            throw new InvalidArgumentException("Limit argument can't be negative");
        }

        $numberList = [];

        for ($i = 0; $i <= $limit; $i++) {
            if ($i % 2 !== 0) {
                $numberList[] = $i;
            }
        }

        return $numberList;
    }
}
