<?php

namespace Bencoderus\BureauDeChange\Exchange;

use Bencoderus\BureauDeChange\Clients\CryptoClient;
use Bencoderus\BureauDeChange\Clients\FiatClient;

class CryptoExchanger
{
    /**
     * Get all rates both crypto and fiat rate.
     *
     * @param string $currencyType
     * @param string|null $base
     *
     * @return mixed
     *
     * @throws \Bencoderus\BureauDeChange\Exceptions\ClientException
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
     * Convert Crypto to USD.
     *
     * @param float $amount
     * @param string $from
     * @param string $to
     *
     * @return float|int
     *
     * @throws \Bencoderus\BureauDeChange\Exceptions\ClientException
     */
    public function convertCryptoToUsd(float $amount, string $from, string $to = 'USD')
    {
        $currency = strtolower($from);
        $rates = $this->getRates(Currency::TYPES['CRYPTO']);

        $baseRate = $rates[$currency]['value'];
        $usdRate = $rates['usd']['value'];

        $btcValue = 1 / $baseRate;
        $rateToUsd = $usdRate * $btcValue;

        return $amount * $rateToUsd;
    }

    /**
     * Convert a crypto currency to another crypto currency.
     *
     * @param float $amount
     * @param string $from
     * @param string $to
     *
     * @return float|int
     *
     * @throws \Bencoderus\BureauDeChange\Exceptions\ClientException
     */
    public function convertCryptoToCrypto(float $amount, string $from, string $to = 'BTC')
    {
        $to = strtolower($to);
        $from = strtolower($from);
        $rates = $this->getRates(Currency::TYPES['CRYPTO']);

        $baseRate = $rates[$from]['value'];
        $toRate = $rates[$to]['value'];

        $btcValue = 1 / $baseRate;
        $rateToUsd = $toRate * $btcValue;

        return $amount * $rateToUsd;
    }

    /**
     * Convert USD to a crypto currency.
     *
     * @param float $amount
     * @param string $from
     * @param string $to
     *
     * @return float|int
     *
     * @throws \Bencoderus\BureauDeChange\Exceptions\ClientException
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

        return $amount * $rateToUsd;
    }

    /**
     * Fiat currencies conversion.
     *
     * @param float $amount
     * @param string $from
     * @param string $to
     *
     * @return float|int
     *
     * @throws \Bencoderus\BureauDeChange\Exceptions\ClientException
     */
    public function convertFiatToFiat(float $amount, string $from, string $to = 'USD')
    {
        $from = strtoupper($from);
        $rates = $this->getRates(Currency::TYPES['FIAT'], $from);

        return $rates[$to] * $amount;
    }

    /**
     * Convert a fiat currency to crypto.
     *
     * @param float $amount
     * @param string $from
     * @param string $to
     *
     * @return float|int
     *
     * @throws \Bencoderus\BureauDeChange\Exceptions\ClientException
     */
    public function convertFiatToCrypto(float $amount, string $from, string $to = 'USD')
    {
        $usd = $this->convertFiatToFiat($amount, $from, 'USD');

        return $this->convertUsdToCrypto($usd, 'USD', $to);
    }

    /**
     * Convert a crypto currency to fiat.
     *
     * @param float $amount
     * @param string $from
     * @param string $to
     *
     * @return float|int
     *
     * @throws \Bencoderus\BureauDeChange\Exceptions\ClientException
     */
    public function convertCryptoToFiat(float $amount, string $from, string $to)
    {
        $usd = $this->convertCryptoToUsd($amount, $from, 'USD');

        return $this->convertFiatToFiat($usd, 'USD', $to);
    }
}
