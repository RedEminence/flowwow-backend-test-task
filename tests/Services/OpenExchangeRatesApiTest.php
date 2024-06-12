<?php

use GuzzleHttp\Exception\ClientException;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use App\DTO\LatestRatesDTO;
use App\Services\OpenExchangeRatesApi;
use App\Exceptions\CouldNotGetResultFromApiException;


class OpenExchangeRatesApiTest extends TestCase
{
    public function testGetLatestRates()
    {
        $base = "USD";
        $rates = ["EUR" => 0.84, "AED" => 0.27];
        $timestamp = 1718225145;

        $mockClient = $this->createMock(Client::class);
        $responseBody = json_encode([
            "base" => $base,
            "rates" => $rates,
            "timestamp" => $timestamp
        ]);

        $mockClient->method("request")->willReturn(new Response(200, [], $responseBody));

        $api = new OpenExchangeRatesApi($mockClient, "some-api-key");
        $result = $api->getLatestRates();

        $this->assertInstanceOf(LatestRatesDTO::class, $result);
        $this->assertEquals($base, $result->base);
        $this->assertEquals($rates, $result->rates);
        $this->assertEquals($timestamp, $result->timestamp);
    }

    public function testGetLatestRatesWithException()
    {
        $this->expectException(CouldNotGetResultFromApiException::class);
        
        $mockClient = $this->createMock(Client::class);
        $mockClient->method('request')->willThrowException(new ClientException('Error', new Request('GET', 'test'),new Response(401)));

        $api = new OpenExchangeRatesAPI($mockClient, 'dummy_api_key');
        $api->getLatestRates();
    }
}