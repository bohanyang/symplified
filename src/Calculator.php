<?php

declare(strict_types=1);

namespace App;

final class Calculator
{
    public function __construct(private $overflow)
    {
    }

    public function add(int $a, int $b): int
    {
        return $a + $b + $this->overflow;
    }
}
