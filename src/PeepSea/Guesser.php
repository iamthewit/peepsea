<?php

namespace PeepSea;

class Guesser
{
    private string $name;

    /**
     * Guesser constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }


}