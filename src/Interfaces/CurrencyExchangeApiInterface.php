<?php

namespace App\Interfaces;

use App\DTO\LatestRatesDTO;


interface CurrencyExchangeApiInterface
{
    public function getLatestRates(): LatestRatesDTO;
}