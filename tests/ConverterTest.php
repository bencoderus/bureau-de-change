<?php

namespace Bencoderus\CurrencyConverter\Tests;

use Bencoderus\CurrencyConverter\Converter;
use PHPUnit\Framework\TestCase;

class ConverterTest extends TestCase
{

    public function testVerifyCurrenciesAreSet()
    {
        $convert = new Converter();
        $convert->currency('USD', 'EUR');

        $this->assertEquals('USD', $convert->baseCurrency);
        $this->assertEquals('EUR', $convert->destinationCurrency);
    }

}
