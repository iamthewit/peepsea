<?php

namespace Entity;

use ArrayIterator;
use Countable;
use Exception\PeepSeaEntityCollectionCreationException;
use IteratorAggregate;

class PeepSeaEntityCollection implements IteratorAggregate, Countable
{
    private array $peepSeas;

    /**
     * PeepSeaEntityCollection constructor.
     * @param array $peepSeas
     * @throws PeepSeaEntityCollectionCreationException
     */
    public function __construct(array $peepSeas = [])
    {
        foreach ($peepSeas as $peepSea) {
            if (!is_a($peepSea, PeepSeaEntity::class)) {
                throw new PeepSeaEntityCollectionCreationException(
                    'Can only create a PeepSeaEntityCollection from an array of PeepSea objects.'
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
}