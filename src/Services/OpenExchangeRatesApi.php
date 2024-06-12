<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\DTO\LatestRatesDTO;
use App\Interfaces\CurrencyExchangeApiInterface;
use App\Exceptions\CouldNotGetResultFromApiException;
use GuzzleHttp\Exception\ClientException;


class OpenExchangeRatesApi implements CurrencyExchangeApiInterface
{
    private const BASE_URL = "https://openexchangerates.org/api";

    public function __construct(
        private Client $client, 
        private string $apiKey)
    {}

    public function getLatestRates(): LatestRatesDTO
    {
        $response = $this->makeRequest("GET", "latest.json");

        $dto = new LatestRatesDTO($response["base"], $response["rates"], $response["timestamp"]);

        return $dto;
    }

    private function makeRequest(string $method, string $endpoint): array
    {
        $options = ["headers" => ["Authorization" => "Token " . $this->apiKey]];

        try {
            $response = $this->client->request($method, self::BASE_URL . "/" . $endpoint, $options);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            throw CouldNotGetResultFromApiException::create($response->getStatusCode(), $response->getBody()->getContents());
        }

        $decoded_response = json_decode($response->getBody()->getContents(), true);

        return $decoded_response;
    }
}
