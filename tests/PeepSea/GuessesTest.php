<?php


use PeepSea\Guesses;
use PeepSea\GuessesCreationException;
use PHPUnit\Framework\TestCase;

class GuessesTest extends TestCase
{
    public function testItThrowsGuessesCreationException()
    {
        $this->expectException(GuessesCreationException::class);

        new Guesses([1, 'abc', []]);
    }
}
