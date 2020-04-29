<?php

namespace PeepSea;

use JsonSerializable;

class Image implements JsonSerializable
{
    private string $path;

    /**
     * Image constructor.
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function path(): string
    {
        return $this->path;
    }


    public function jsonSerialize()
    {
        return ['path' => $this->path()];
    }
}