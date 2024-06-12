<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use App\Services\OpenExchangeRatesApi;
use Dotenv\Dotenv;


$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$apiKey = $_ENV['OPENEXCHANGERATES_API_KEY'];

$api = new OpenExchangeRatesApi(new Client(), $apiKey);

$dto = $api->getLatestRates();

$base = $dto->getBase();
print("timestamp: " . $dto->getTimestamp());
print("\n");
print("\n");

foreach ($dto->getRates() as $symbol => $value) {
    print($base . '/' . $symbol . ": " . $value);
    print("\n");
}

