<?php

use PHPUnit\Framework\TestCase;
use App\DTO\LatestRatesDTO;

class LatestRatesDTOTest extends TestCase
{
    public function testConstructorAndGetters()
    {
        $base = 'USD';
        $rates = ['EUR' => 0.84, 'AED' => 0.27];
        $timestamp = 1718225145;

        $dto = new LatestRatesDTO($base, $rates, $timestamp);

        $this->assertEquals($base, $dto->getBase());
        $this->assertEquals($rates, $dto->getRates());
        $this->assertEquals($timestamp, $dto->getTimestamp());
    }
}