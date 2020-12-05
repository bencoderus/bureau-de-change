<?php

namespace Bencoderus\CurrencyConverter\Exchange;

use Bencoderus\CurrencyConverter\Clients\CryptoClient;
use Bencoderus\CurrencyConverter\Clients\FiatClient;

class CryptoExchanger
{
    /**
     * @param string $currencyType
     * @param string|null $base
     * @return mixed
     * @throws \Bencoderus\CurrencyConverter\Exceptions\ClientException
     */
    public function getRates(string $currencyType, string $base = null)
    {
        if ($currencyType === Currency::TYPES['CRYPTO']) {
            return (new CryptoClient())->getRates();
        } elseif ($currencyType === Currency::TYPES['FIAT']) {
            return (new FiatClient())->getRates($base);
        }
    }

    /**
     * @param float $amount
     * @param string $from
     * @param string $to
     * @return float|int
     * @throws \Bencoderus\CurrencyConverter\Exceptions\ClientException
     */
    public function convertCryptoToUsd(float $amount, string $from, string $to = 'USD')
    {
        $currency = strtolower($from);
        $rates = $this->getRates(Currency::TYPES['CRYPTO']);

        $baseRate = $rates[$currency]['value'];
        $usdRate = $rates['usd']['value'];

        $btcValue = 1 / $baseRate;
        $rateToUsd = $usdRate * $btcValue;

        return ($amount * $rateToUsd);
    }

    /**
     * @param float $amount
     * @param string $from
     * @param string $to
     * @return float|int
     * @throws \Bencoderus\CurrencyConverter\Exceptions\ClientException
     */
    public function convertCryptoToCrypto(float $amount, string $from, string $to = 'BTC')
    {
        $to = strtoupper($to);
        $from = strtolower($from);
        $rates = $this->getRates(Currency::TYPES['CRYPTO']);

        $baseRate = $rates[$from]['value'];
        $toRate = $rates[$to]['value'];

        $btcValue = 1 / $baseRate;
        $rateToUsd = $toRate * $btcValue;

        return ($amount * $rateToUsd);
    }

    /**
     * @param float $amount
     * @param string $from
     * @param string $to
     * @return float|int
     * @throws \Bencoderus\CurrencyConverter\Exceptions\ClientException
     */
    public function convertUsdToCrypto(float $amount, string $from, string $to)
    {
        $to = strtolower($to);
        $currency = strtolower('USD');

        $rates = $this->getRates(Currency::TYPES['CRYPTO']);

        $baseRate = $rates[$currency]['value'];
        $toRate = $rates[$to]['value'];

        $btcValue = 1 / $baseRate;
        $rateToUsd = $toRate * $btcValue;

        return ($amount * $rateToUsd);
    }

    /**
     * @param float $amount
     * @param string $from
     * @param string $to
     * @return float|int
     * @throws \Bencoderus\CurrencyConverter\Exceptions\ClientException
     */
    public function convertFiatToFiat(float $amount, string $from, string $to = 'USD')
    {
        $from = strtoupper($from);
        $rates = $this->getRates(Currency::TYPES['FIAT'], $from);

        return $rates[$to] * $amount;
    }

    /**
     * @param float $amount
     * @param string $from
     * @param string $to
     * @return float|int
     * @throws \Bencoderus\CurrencyConverter\Exceptions\ClientException
     */
    public function convertFiatToCrypto(float $amount, string $from, string $to = 'USD')
    {
        $usd = $this->convertFiatToFiat($amount, $from, 'USD');

        return $this->convertUsdToCrypto($usd, 'USD', $to);
    }

    /**
     * @param float $amount
     * @param string $from
     * @param string $to
     * @return float|int
     * @throws \Bencoderus\CurrencyConverter\Exceptions\ClientException
     */
    public function convertCryptoToFiat(float $amount, string $from, string $to)
    {
        $usd = $this->convertCryptoToUsd($amount, $from, 'USD');

        return $this->convertFiatToFiat($usd, 'USD', $to);

    }
}