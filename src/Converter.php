<?php

namespace Bencoderus\CurrencyConverter;

use Bencoderus\CurrencyConverter\Exceptions\UnsupportedException;
use Bencoderus\CurrencyConverter\Exchange\Currency;
use Bencoderus\CurrencyConverter\Exchange\ExchangeEngine;

class Converter
{
    /**
     * The currency code you want from.
     * @var string
     */
    public $baseCurrency;

    /** The currency code you want to.
     * @var
     */
    public $destinationCurrency;

    /**
     * Convert from base currency to destination currency.
     * @param string $from
     * @param string $to
     *
     * @return $this
     *
     * @throws \Bencoderus\CurrencyConverter\Exceptions\UnsupportedException
     */
    public function currency(string $from, string $to): self
    {
        if (! Currency::isSupported($from) || ! Currency::isSupported($to)) {
            throw new UnsupportedException("Currency is not supported.");
        }

        $this->baseCurrency = $from;
        $this->destinationCurrency = $to;

        return $this;
    }

    /**
     * Convert currency from base currency to destination currency.
     *
     * @param float $amount
     * @return float|int
     * @throws \Bencoderus\CurrencyConverter\Exceptions\ClientException
     */
    public function convert(float $amount)
    {
        $convert = new ExchangeEngine($this->baseCurrency, $this->destinationCurrency);

        return $convert->convert($amount);
    }
}
