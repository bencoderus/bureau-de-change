<?php

namespace Bencoderus\BureauDeChange\Exchange;

class Currency
{
    const TYPES = [
        'FIAT' => 'fiat',
        'CRYPTO' => 'crypto',
    ];

    /**
     * Verifies if a currency code is supported for conversion.
     *
     * @param string $currency
     *
     * @return bool
     */
    public static function isSupported(string $currency): bool
    {
        return in_array($currency, self::supportedCurrencies());
    }

    /**
     * Verifies if a currency is supported fiat currency.
     *
     * @param string $currency
     * @return bool
     */
    public static function isFiat(string $currency): bool
    {
        return in_array($currency, self::fiatCurrencies());
    }

    /**
     * Verifies if a currency is supported crypto currency.
     *
     * @param string $currency
     * @return bool
     */
    public static function isCrypto(string $currency): bool
    {
        return in_array($currency, self::cryptoCurrencies());
    }

    /**
     * Generate an array of supported currencies (fiat and crypto).
     *
     * @return array
     */
    public static function supportedCurrencies()
    {
        return array_merge(self::fiatCurrencies(), self::cryptoCurrencies());
    }

    /**
     * Get all supported crypto currencies.
     */
    public static function cryptoCurrencies(): array
    {
        return [
            'BTC',
            'ETH',
            'LTC',
            'BCH',
            'BNB',
            'EOS',
            'BNB',
            'XLM',
            'DOT',
            'LINK',
            'YFI',
            'XRP',
        ];
    }

    /**
     * Get the list of all the supported currencies.
     *
     * @return array
     */
    protected static function fiatCurrencies(): array
    {
        return [
            'CAD',
            'HKD',
            'ISK',
            'PHP',
            'DKK',
            'HUF',
            'CZK',
            'GBP',
            'RON',
            'SEK',
            'IDR',
            'INR',
            'BRL',
            'RUB',
            'HRK',
            'JPY',
            'THB',
            'CHF',
            'EUR',
            'MYR',
            'BGN',
            'TRY',
            'CNY',
            'NOK',
            'NZD',
            'ZAR',
            'USD',
            'MXN',
            'SGD',
            'AUD',
            'ILS',
            'KRW',
            'PLN',
        ];
    }
}
