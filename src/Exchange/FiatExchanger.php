<?php

namespace Bencoderus\CurrencyConverter\Exchange;

use Bencoderus\CurrencyConverter\Clients\FiatClient;

class FiatExchanger
{
    /**
     * Get all the fiat currencies rates.
     *
     * @param string $from
     * @return mixed
     * @throws \Bencoderus\CurrencyConverter\Exceptions\ClientException
     */
    public function getRates(string $from)
    {
        return (new FiatClient())->getRates($from);
    }

    /**
     * Convert from one fiat currency to another.
     *
     * @param float $amount
     * @param string $from
     * @param string $to
     * @return float|int
     * @throws \Bencoderus\CurrencyConverter\Exceptions\ClientException
     */
    public function convertFiatToFiat(float $amount, string $from, string $to)
    {
        $rates = $this->getRates($from);

        return $rates[$to] * $amount;
    }


}
