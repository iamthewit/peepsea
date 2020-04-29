<?php

namespace Test\Factory;

use Entity\PeepSeaEntity;
use Factory\PeepSeaFactory;
use PeepSea\Guess;
use PeepSea\Guesses;
use PeepSea\PeepSea;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class PeepSeaFactoryTest extends TestCase
{

    public function testBuildGuessesFromPeepSeaEntity()
    {
        $peepSeaEntity = new PeepSeaEntity(
            Uuid::uuid4()->toString(),
            'Answer',
            [],
            [
                [
                    'guesser' => 'Guesser Name',
                    'text' => 'Guess Text',
                ]
            ]
        );

        $guesses = PeepSeaFactory::buildGuessesFromPeepSeaEntity($peepSeaEntity);

        $this->assertInstanceOf(Guesses::class, $guesses);
        $this->assertCount(1, $guesses);
        $this->assertInstanceOf(Guess::class, $guesses->toArray()[0]);
    }

    public function testBuildFromPeepSeaEntity()
    {
        $id = Uuid::uuid4()->toString();
        $peepSeaEntity = new PeepSeaEntity($id, 'Answer', [], []);

        $peepSea = PeepSeaFactory::buildFromPeepSeaEntity($peepSeaEntity);

        $this->assertInstanceOf(PeepSea::class, $peepSea);
    }
}
