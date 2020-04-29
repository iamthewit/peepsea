<?php

namespace Test\Application;

use Application\CreatePeepSea;
use PeepSea\PeepSea;
use PHPUnit\Framework\TestCase;
use Repository\PeepSeaRepositoryInterface;

class CreatePeepSeaTest extends TestCase
{
    public function testItReturnsAPeepSea()
    {
        $repoMock = \Mockery::mock(PeepSeaRepositoryInterface::class);
        $repoMock->shouldReceive('store');

        $createPeepSea = new CreatePeepSea($repoMock);
        $peepSea = $createPeepSea->create('Answer', []);

        $this->assertInstanceOf(PeepSea::class, $peepSea);
    }
}
