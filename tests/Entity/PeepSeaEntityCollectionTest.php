<?php

namespace Entity;

use Exception\PeepSeaEntityCollectionCreationException;
use PHPUnit\Framework\TestCase;

class PeepSeaEntityCollectionTest extends TestCase
{

    /**
     * @dataProvider providesInvalidEntities
     */
    public function testItThrowsPeepSeaEntityCollectionCreationException($badEntity)
    {
        $this->expectException(PeepSeaEntityCollectionCreationException::class);

        new PeepSeaEntityCollection([$badEntity]);
    }
    
    public function testToArray()
    {
        $collection = new PeepSeaEntityCollection([
            new PeepSeaEntity(
                '123',
                'Answer',
                ['image1.png'],
                ['"guesser":"Guesser Name", "guess": "Guess Text"']
            )
        ]);

        $this->assertIsIterable($collection);
        $this->assertIsArray((array) $collection);
        $this->assertIsArray($collection->toArray());
        $this->assertEquals(
            [
                new PeepSeaEntity(
                    '123',
                    'Answer',
                    ['image1.png'],
                    ['"guesser":"Guesser Name", "guess": "Guess Text"']
                )
            ],
            $collection->toArray()
        );
    }

    public function testCount()
    {
        $collection = new PeepSeaEntityCollection([
            new PeepSeaEntity(
                '123',
                'Answer',
                ['image1.png'],
                ['"guesser":"Guesser Name", "guess": "Guess Text"']
            ),
            new PeepSeaEntity(
                '456',
                'Answer',
                ['image1.png'],
                ['"guesser":"Guesser Name", "guess": "Guess Text"']
            ),
            new PeepSeaEntity(
                '789',
                'Answer',
                ['image1.png'],
                ['"guesser":"Guesser Name", "guess": "Guess Text"']
            )
        ]);

        $this->assertEquals(3, $collection->count());
        $this->assertCount(3, $collection);
    }

    public function providesInvalidEntities()
    {
        return [
            [123],
            ['213'],
            [new \stdClass()]
        ];
    }
}
