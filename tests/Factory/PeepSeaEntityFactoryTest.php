<?php

use Entity\PeepSeaEntity;
use Factory\PeepSeaEntityFactory;
use PeepSea\Guess;
use PeepSea\Guesser;
use PeepSea\Guesses;
use PeepSea\Image;
use PeepSea\Images;
use PeepSea\PeepSea;
use PHPUnit\Framework\TestCase;

class PeepSeaEntityFactoryTest extends TestCase
{

    public function testBuildEntityFromDatabaseRow()
    {
        $peepSeaEntity = PeepSeaEntityFactory::buildEntityFromDatabaseRow([
           'answer' => 'Answer Text',
           'images' => 'image1.png,image2.png,image3.png',
           'guesses' => json_encode([
               [
                   'text' => 'Guess Text',
                   'guesser' => 'Guesser Name'
               ]
           ])
        ]);
        
        $this->assertInstanceOf(PeepSeaEntity::class, $peepSeaEntity);
        $this->assertEquals('Answer Text', $peepSeaEntity->getAnswer());
        $this->assertEquals(['image1.png', 'image2.png', 'image3.png'], $peepSeaEntity->getImages());

        $guessObject = new stdClass();
        $guessObject->text = 'Guess Text';
        $guessObject->guesser = 'Guesser Name';
        $this->assertEquals([$guessObject], $peepSeaEntity->getGuesses());
    }

    public function testBuildEntityFromPeepSea()
    {
        $peepSeaEntity = PeepSeaEntityFactory::buildEntityFromPeepSea(
            new PeepSea(
                'Answer String',
                new Images([
                    new Image('image1.png'),
                    new Image('image2.png'),
                    new Image('image3.png')
                ]),
                new Guesses([
                    new Guess(
                        new Guesser('Guesser Name'),
                        'Guess Text'
                    )
                ])
            )
        );

        $this->assertInstanceOf(PeepSeaEntity::class, $peepSeaEntity);
    }
}
