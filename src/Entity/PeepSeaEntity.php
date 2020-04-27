<?php

namespace Entity;

class PeepSeaEntity implements \JsonSerializable
{
    private string $id;
    private string $answer;
    private array $images;
    private array $guesses;

    public function __construct(string $id, string $answer, array $images, array $guesses)
    {
        $this->id = $id;
        $this->answer = $answer;
        $this->images = $images;
        $this->guesses = $guesses;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
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

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'answer' => $this->getAnswer(),
            'images' => $this->getImages(),
            'guesses' => $this->getGuesses()
        ];
    }
}