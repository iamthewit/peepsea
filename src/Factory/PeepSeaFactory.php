<?php

namespace Factory;

use Entity\PeepSeaEntity;
use PeepSea\Guess;
use PeepSea\Guesser;
use PeepSea\Guesses;
use PeepSea\Image;
use PeepSea\Images;
use PeepSea\PeepSea;
use Ramsey\Uuid\Uuid;

class PeepSeaFactory
{
    public static function buildFromPeepSeaEntity(PeepSeaEntity $peepSeaEntity): PeepSea
    {
        return new PeepSea(
            Uuid::fromString($peepSeaEntity->getId()),
            $peepSeaEntity->getAnswer(),
            self::buildImagesFromPeepSeaEntity($peepSeaEntity),
            self::buildGuessesFromPeepSeaEntity($peepSeaEntity)
        );
    }

    public static function buildGuessesFromPeepSeaEntity(PeepSeaEntity $peepSeaEntity): Guesses
    {
        $guesses = [];
        foreach ($peepSeaEntity->getGuesses() as $guessFromEntity) {
            $guesses[] = new Guess(
                new Guesser($guessFromEntity['guesser']),
                $guessFromEntity['text']
            );
        }

        return new Guesses($guesses);
    }

    public static function buildImagesFromPeepSeaEntity(PeepSeaEntity $peepSeaEntity): Images
    {
        $images = [];
        foreach ($peepSeaEntity->getImages() as $imageFromEntity) {
            $images[] = new Image($imageFromEntity);
        }

        return new Images($images);
    }
}