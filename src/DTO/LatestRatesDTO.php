<?php

namespace App\DTO;

class LatestRatesDTO
{
    public function __construct(
        private string $base,
        private array $rates,
        private int $timestamp
    ) {}

    public function getBase(): string
    {
        return $this->base;
    }

    public function getRates(): array
    {
        return $this->rates;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }
}
