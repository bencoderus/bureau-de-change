<?php

namespace Bencoderus\CurrencyConverter\Clients;

use Bencoderus\CurrencyConverter\Exceptions\ClientException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class FiatClient
{
    public $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.exchangeratesapi.io'
        ]);
    }

    /**
     * Send request to retrieve exchange rates.
     *
     * @param string $baseCurrency
     *
     * @return mixed
     *
     * @throws \Bencoderus\CurrencyConverter\Exceptions\ClientException
     */
    public function getRates(string $baseCurrency)
    {
        try {
            $response = $this->client->get("/latest?base={$baseCurrency}");

            return json_decode($response->getBody(), true)['rates'];

        } catch (GuzzleException $error) {
            throw new ClientException("Unable to connect to API");
        }
    }
}
