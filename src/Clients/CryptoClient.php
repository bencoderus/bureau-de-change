<?php

namespace Bencoderus\CurrencyConverter\Clients;

use Bencoderus\CurrencyConverter\Exceptions\ClientException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class CryptoClient
{
    public $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://api.coingecko.com']);
    }

    /**
     * Send request to retrieve exchange rates.
     *
     * @return mixed
     *
     * @throws \Bencoderus\CurrencyConverter\Exceptions\ClientException
     */
    public function getRates()
    {
        try {
            $response = $this->client->get("/api/v3/exchange_rates");

            return json_decode($response->getBody(), true)['rates'];

        } catch (GuzzleException $error) {
            throw new ClientException("Unable to retrieve rate.");

        }
    }
}
