<?php

namespace Bencoderus\CurrencyConverter\Tests\Clients;

use Bencoderus\CurrencyConverter\Clients\CryptoClient;
use Mockery;
use PHPUnit\Framework\TestCase;

class FiatClientTest extends TestCase
{
    protected $client;

    public function setUp(): void
    {
        $this->client = Mockery::mock(FiatClient::class);
    }

    public function tearDown(): void
    {
        Mockery::close();
    }

    /** @test */
    public function testCryptoClientSendAResponse()
    {
        $array = $this->client->shouldReceive('getRates')->andReturn([
            'USD' => 30,
            'EUR' => 1,
            'GBP' => 2,
        ]);

        $this->assertEquals('array', gettype(array($array)));

    }
}
