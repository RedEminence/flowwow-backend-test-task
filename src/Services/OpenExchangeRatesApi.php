<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\DTO\LatestRatesDTO;
use App\Interfaces\CurrencyExchangeApiInterface;
use App\Exceptions\CouldNotGetResultFromApiException;
use GuzzleHttp\Exception\ClientException;


class OpenExchangeRatesApi implements CurrencyExchangeApiInterface
{
    private string $baseUrl = "https://openexchangerates.org/api";

    private string $apiKey;

    private Client $client;

    public function __construct(Client $client, string $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    public function getLatestRates(): LatestRatesDTO
    {
        $response = $this->makeRequest("GET", "latest.json");

        $dto = new LatestRatesDTO($response["base"], $response["rates"], $response["timestamp"]);

        return $dto;
    }

    private function makeRequest(string $method, string $endpoint, array $options = []): array
    {
        $allOptions = array_merge($options, ["headers" => ["Authorization" => "Token ы" . $this->apiKey]]);
        
        try {
            $response = $this->client->request($method, $this->baseUrl . "/" . $endpoint, $allOptions);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            throw CouldNotGetResultFromApiException::create($response->getStatusCode(), $response->getBody()->getContents());
        }

        $decoded_response = json_decode($response->getBody()->getContents(), true);

        return $decoded_response;
    }
}
