<?php

namespace PeepSea;

use ArrayIterator;
use Countable;
use Exception\PeepSeaCollectionCreationException;
use IteratorAggregate;
use JsonSerializable;

class PeepSeaCollection implements IteratorAggregate, Countable, JsonSerializable
{
    private array $peepSeas;

    /**
     * PeepSeaCollection constructor.
     * @param array $peepSeas
     * @throws PeepSeaCollectionCreationException
     */
    public function __construct(array $peepSeas = [])
    {
        foreach ($peepSeas as $peepSea) {
            if (!is_a($peepSea, PeepSea::class)) {
                throw new PeepSeaCollectionCreationException(
                    'Can only create a PeepSeaCollection from an array of PeepSea objects.'
                );
            }

            $this->peepSeas[] = $peepSea;
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->peepSeas;
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->peepSeas);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->peepSeas);
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}