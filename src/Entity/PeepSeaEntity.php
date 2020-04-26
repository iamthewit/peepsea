<?php

namespace Entity;

class PeepSeaEntity
{
    private string $answer;
    private array $images;
    private array $guesses;

    public function __construct(string $answer, array $images, array $guesses)
    {
        $this->answer = $answer;
        $this->images = $images;
        $this->guesses = $guesses;
    }

    /**
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }

    /**
     * @param string $answer
     */
    public function setAnswer(string $answer): void
    {
        $this->answer = $answer;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @param array $images
     */
    public function setImages(array $images): void
    {
        $this->images = $images;
    }

    /**
     * @return array
     */
    public function getGuesses(): array
    {
        return $this->guesses;
    }

    /**
     * @param array $guesses
     */
    public function setGuesses(array $guesses): void
    {
        $this->guesses = $guesses;
    }
}