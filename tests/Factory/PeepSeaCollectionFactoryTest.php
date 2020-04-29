<?php

namespace Test\Factory;

use Entity\PeepSeaEntity;
use Entity\PeepSeaEntityCollection;
use Factory\PeepSeaCollectionFactory;
use PeepSea\PeepSeaCollection;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class PeepSeaCollectionFactoryTest extends TestCase
{

    public function testBuildFromPeepSeaEntityCollection()
    {
        $peepSeaEntity = new PeepSeaEntity(
            Uuid::uuid4()->toString(),
            'Answer',
            [],
            []
        );
        $peepSeaEntityCollection = new PeepSeaEntityCollection([$peepSeaEntity]);
        $peepSeaCollection = PeepSeaCollectionFactory::buildFromPeepSeaEntityCollection($peepSeaEntityCollection);

        $this->assertInstanceOf(PeepSeaCollection::class, $peepSeaCollection);
    }
}
