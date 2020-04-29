<?php

namespace PeepSea;

use ArrayIterator;
use Countable;
use Exception\ImagesCreationException;
use IteratorAggregate;
use JsonSerializable;
use Traversable;

class Images implements IteratorAggregate, Countable, JsonSerializable
{
    private array $images;

    /**
     * Images constructor.
     * @param array $images
     * @throws ImagesCreationException
     */
    public function __construct(array $images)
    {
        $this->images = [];

        foreach ($images as $image) {
            if (!is_a($image, Image::class)) {
                throw new ImagesCreationException(
                    'Can only create an Images object from an array of Image objects.'
                );
            }

            $this->images[] = $image;
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->images;
    }

    /**
     * @return ArrayIterator|Traversable
     */
    public function getIterator()
    {
        return new ArrayIterator($this->images);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->images);
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}