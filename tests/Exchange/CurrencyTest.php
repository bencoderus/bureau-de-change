<?php

namespace Bencoderus\CurrencyConverter\Tests\Exchange;

use Bencoderus\CurrencyConverter\Exchange\Currency;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{

    public function testCheckIfAValidCurrencyIsSupported(): void
    {
        $isSupported = Currency::isSupported('USD');
        $this->assertTrue($isSupported);
    }

    public function testCheckIfAnInvalidCurrencyIsSupported(): void
    {
        $isSupported = Currency::isSupported('BEN');
        $this->assertFalse($isSupported);
    }

    public function testCheckIfACurrencyIsAFiatCurrency(): void
    {
        $isFiat = Currency::isFiat('EUR');
        $this->assertTrue($isFiat);
    }

    public function testCheckIfACurrencyIsNotAFiatCurrency(): void
    {
        $isFiat = Currency::isFiat('BTC');
        $this->assertFalse($isFiat);
    }

    public function testCheckIfACurrencyIsACryptoCurrency(): void
    {
        $isCrypto = Currency::isCrypto('BTC');
        $this->assertTrue($isCrypto);
    }

    public function testCheckIfACurrencyIsNotACryptoCurrency(): void
    {
        $isCrypto = Currency::isCrypto('GBP');
        $this->assertFalse($isCrypto);
    }
}