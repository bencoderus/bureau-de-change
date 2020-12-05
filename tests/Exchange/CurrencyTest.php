<?php

namespace Bencoderus\BureauDeChange\Tests\Exchange;

use Bencoderus\BureauDeChange\Exchange\Currency;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{

    public function testCheckIfAValidCurrencyIsSupported()
    {
        $isSupported = Currency::isSupported('USD');
        $this->assertTrue($isSupported);
    }

    public function testCheckIfAnInvalidCurrencyIsSupported()
    {
        $isSupported = Currency::isSupported('BEN');
        $this->assertFalse($isSupported);
    }

    public function testCheckIfACurrencyIsAFiatCurrency()
    {
        $isFiat = Currency::isFiat('EUR');
        $this->assertTrue($isFiat);
    }

    public function testCheckIfACurrencyIsNotAFiatCurrency()
    {
        $isFiat = Currency::isFiat('BTC');
        $this->assertFalse($isFiat);
    }

    public function testCheckIfACurrencyIsACryptoCurrency()
    {
        $isCrypto = Currency::isCrypto('BTC');
        $this->assertTrue($isCrypto);
    }

    public function testCheckIfACurrencyIsNotACryptoCurrency()
    {
        $isCrypto = Currency::isCrypto('GBP');
        $this->assertFalse($isCrypto);
    }
}
