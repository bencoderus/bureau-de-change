<?php

namespace Bencoderus\BureauDeChange\Exchange;

use Bencoderus\BureauDeChange\Exceptions\ClientException;
use Bencoderus\BureauDeChange\Exceptions\UnsupportedException;
use Exception;

class ExchangeEngine
{
    protected $crypto;
    protected $fiat;
    protected $to;
    protected $from;

    public function __construct(string $from, string $to)
    {
        $this->from = $from;
        $this->to = $to;
        $this->crypto = new CryptoExchanger();
        $this->fiat = new FiatExchanger();
    }

    /**
     * Convert currency from one currency (fiat, crypto) to another.
     *
     * @param float $amount
     *
     * @return float|int
     *
     * @throws \Bencoderus\BureauDeChange\Exceptions\ClientException
     */
    public function convert(float $amount)
    {
        try {
            if (Currency::isCrypto($this->from) && Currency::isCrypto($this->to)) {
                return $this->crypto->convertCryptoToCrypto($amount, $this->from, $this->to);
            }

            if (Currency::isFiat($this->from) && Currency::isCrypto($this->to)) {
                return $this->crypto->convertFiatToCrypto($amount, $this->from, $this->to);
            }

            if (Currency::isCrypto($this->from) && Currency::isFiat($this->to)) {
                return $this->crypto->convertCryptoToFiat($amount, $this->from, $this->to);
            }

            if (Currency::isFiat($this->from) && Currency::isFiat($this->to)) {
                return $this->fiat->convertFiatToFiat($amount, $this->from, $this->to);
            }

            throw new UnsupportedException('Currency is not supported');
        } catch (Exception $error) {
            throw new ClientException('Unable to retrieve rate.');
        }
    }
}
