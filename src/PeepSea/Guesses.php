<?php


class Guesses implements IteratorAggregate, Countable
{
    private array $guesses;

    /**
     * Images constructor.
     * @param array $guesses
     */
    private function __construct(array $guesses)
    {
        foreach ($guesses as $guess) {
            if (!is_a($guess, Image::class)) {
                throw new GuessesCreationException(
                    'Can only create a Guesses object from an array of Guess objects.'
                );
            }

            $this->guesses[] = $guess
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->guesses;
    }

    /**
     * @return ArrayIterator|Traversable
     */
    public function getIterator()
    {
        return new ArrayIterator($this->guesses);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->guesses);
    }
}