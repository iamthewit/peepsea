<?php

namespace Test\Application;

use Application\PeepSeaService;
use Entity\PeepSeaEntity;
use Entity\PeepSeaEntityCollection;
use PeepSea\PeepSea;
use PeepSea\PeepSeaCollection;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Repository\PeepSeaRepositoryInterface;

class PeepSeaServiceTest extends TestCase
{
    public function testItReturnsAPeepSea()
    {
        $repoMock = \Mockery::mock(PeepSeaRepositoryInterface::class);
        $repoMock->shouldReceive('store');

        $peepSeaService = new PeepSeaService($repoMock);
        $peepSea = $peepSeaService->create('Answer', []);

        $this->assertInstanceOf(PeepSea::class, $peepSea);
    }

    public function testFetchAll()
    {
        $repoMock = \Mockery::mock(PeepSeaRepositoryInterface::class);
        $repoMock->shouldReceive('all')->andReturn(
            new PeepSeaEntityCollection([
                new PeepSeaEntity(
                    Uuid::uuid4()->toString(),
                    'Answer',
                    [],
                    []
                ),
                new PeepSeaEntity(
                    Uuid::uuid4()->toString(),
                    'Answer',
                    [],
                    []
                )
            ])
        );

        $peepSeaService = new PeepSeaService($repoMock);
        $peepSeaCollection = $peepSeaService->fetchAll();

        $this->assertInstanceOf(PeepSeaCollection::class, $peepSeaCollection);
    }
}
