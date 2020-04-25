<?php

namespace PeepSea;

class Guess
{
    private Guesser $guesser;
    private string $text;

    /**
     * Guess constructor.
     * @param Guesser $guesser
     * @param string $text
     */
    public function __construct(Guesser $guesser, string $text)
    {
        $this->guesser = $guesser;
        $this->text = $text;
    }

    /**
     * @return Guesser
     */
    public function guesser()
    {
        return $this->guesser;
    }

    /**
     * @return string
     */
    public function text()
    {
        return $this->text;
    }
}