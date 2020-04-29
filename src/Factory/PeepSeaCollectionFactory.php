<?php

namespace Factory;

use Entity\PeepSeaEntityCollection;
use PeepSea\PeepSeaCollection;

class PeepSeaCollectionFactory
{
    public static function buildFromPeepSeaEntityCollection(PeepSeaEntityCollection $peepSeaEntityCollection): PeepSeaCollection
    {
        $peepSeas = [];
        foreach ($peepSeaEntityCollection as $peepSeaEntity) {
            $peepSeas[] = PeepSeaFactory::buildFromPeepSeaEntity($peepSeaEntity);
        }

        return new PeepSeaCollection($peepSeas);
    }
}