<?php

namespace Bencoderus\BureauDeChange\Tests\Clients;

use Bencoderus\BureauDeChange\Clients\CryptoClient;
use Mockery;
use PHPUnit\Framework\TestCase;

class CryptoClientTest extends TestCase
{
    protected $client;

    public function setUp(): void
    {
        $this->client = Mockery::mock(CryptoClient::class);
    }

    public function tearDown(): void
    {
        Mockery::close();
    }

    /** @test */
    public function testCryptoClientSendAResponse()
    {
        $array = $this->client->shouldReceive('getRates')->andReturn([
            'btc' => ['value' => 1],
            'eth' => ['value' => 33],
        ]);

        $this->assertEquals('array', gettype(array($array)));
    }
}
