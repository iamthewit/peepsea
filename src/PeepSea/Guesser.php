<?php

namespace PeepSea;

use JsonSerializable;

class Guesser implements JsonSerializable
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


    public function jsonSerialize()
    {
        return ['name' => $this->name()];
    }
}