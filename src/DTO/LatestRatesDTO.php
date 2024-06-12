<?php

namespace App\DTO;

class LatestRatesDTO
{
    public function __construct(
        public readonly string $base,
        public readonly array $rates,
        public readonly int $timestamp
    ) {}
}
