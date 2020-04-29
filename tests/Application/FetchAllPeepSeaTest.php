<?php

namespace Test\Application;

use Application\FetchAllPeepSea;
use Entity\PeepSeaEntity;
use Entity\PeepSeaEntityCollection;
use PeepSea\Guesses;
use PeepSea\Images;
use PeepSea\PeepSea;
use PeepSea\PeepSeaCollection;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Repository\PeepSeaRepositoryInterface;

class FetchAllPeepSeaTest extends TestCase
{

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

        $fetchAllPeepSea = new FetchAllPeepSea($repoMock);
        $peepSeaCollection = $fetchAllPeepSea->fetchAll();

        $this->assertInstanceOf(PeepSeaCollection::class, $peepSeaCollection);
    }
}
