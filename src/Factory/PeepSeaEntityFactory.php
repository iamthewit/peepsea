<?php

namespace Factory;

use Entity\PeepSeaEntity;
use PeepSea\Guess;
use PeepSea\Image;
use PeepSea\PeepSea;

class PeepSeaEntityFactory
{
    public static function buildEntityFromPeepSea(PeepSea $peepSea)
    {
        $images = [];
        foreach ($peepSea->images() as $image) {
            /** @var Image$image */
            $images[] = $image->path();
        }

        $guesses = [];
        foreach ($peepSea->guesses() as $guess) {
            /** @var Guess $guess */
            $guesses[] = [
                'text' => $guess->text(),
                'guesser' => $guess->guesser()->name()
            ];
        }

        return new PeepSeaEntity(
            $peepSea->id(),
            $peepSea->answer(),
            $images,
            $guesses
        );
    }

    public static function buildEntityFromDatabaseRow(array $row)
    {
        /**
         * id - string
         * answer - string
         * images - string, comma delimited
         * guesses - string, json ( {[{text: 'Guess Text', guesser: 'Guesser Name'}]} )
         */

        return new PeepSeaEntity(
            $row['id'],
            $row['answer'],
            explode(',', $row['images']),
            json_decode($row['guesses'], true)
        );
    }
}