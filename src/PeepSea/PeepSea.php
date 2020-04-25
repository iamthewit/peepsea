<?php

namespace PeepSea;

class PeepSea
{
    private string $answer;
    private Images $images;
    private Guesses $guesses;

    /**
     * PeepSea constructor.
     * @param string $answer
     * @param Images $images
     * @param Guesses $guesses
     */
    public function __construct(string $answer, Images $images, Guesses $guesses)
    {
        $this->answer = $answer;
        $this->images = $images;
        $this->guesses = $guesses;
    }

    /**
     * @return string
     */
    public function answer(): string
    {
        return $this->answer;
    }

    /**
     * @return Images
     */
    public function images(): Images
    {
        return $this->images;
    }

    /**
     * @return Guesses
     */
    public function guesses(): Guesses
    {
        return $this->guesses;
    }

    /**
     * @return Guess|null
     */
    public function correctGuess(): ?Guess
    {
        foreach ($this->guesses() as $guess) {
            /** @var Guess $guess */
            if ($guess->text() === $this->answer()) {
                return $guess;
            }
        }

        return null;
    }

    public function hasBeenSolved(): bool
    {
        return (bool) $this->correctGuess();
    }
}