<?php

namespace PeepSea;

class PeepSeaId
{
    private string $id;

    /**
     * PeepSeaId constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id()
    {
        return $this->id;
    }
}