<?php

declare(strict_types=1);

namespace App;

class Calculator
{
    public function __construct(private int $overflow)
    {
    }

    public function add(int $a, int $b): int
    {
        return $a + $b + $this->overflow;
    }
}
