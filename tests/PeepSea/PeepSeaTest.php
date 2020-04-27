<?php

use PeepSea\Guess;
use PeepSea\Guesser;
use PeepSea\Guesses;
use PeepSea\Image;
use PeepSea\Images;
use PeepSea\PeepSea;
use PHPUnit\Framework\TestCase;

class PeepSeaTest extends TestCase
{
    public function testItHasBeenSolved()
    {
        $peepSea = new PeepSea(
            \Ramsey\Uuid\Uuid::uuid4(),
            'Answer Text',
            new Images([
                new Image('path/to/image.png'),
            ]),
            new Guesses([
                new Guess(
                    new Guesser('Guesser Name'),
                    'Guess Text'
                ),
                new Guess(
                    new Guesser('Guesser Name'),
                    'Answer Text'
                )
            ])
        );

        $this->assertTrue($peepSea->hasBeenSolved());
    }

    public function testItReturnsTheCorrectGuess()
    {
        $guess = new Guess(
            new Guesser('Guesser Name'),
            'Answer Text'
        );

        $peepSea = new PeepSea(
            \Ramsey\Uuid\Uuid::uuid4(),
            'Answer Text',
            new Images([
                new Image('path/to/image.png'),
            ]),
            new Guesses([
                new Guess(
                    new Guesser('Guesser Name'),
                    'Guess Text'
                ),
                $guess
            ])
        );

        $this->assertEquals($guess, $peepSea->correctGuess());
    }
}
