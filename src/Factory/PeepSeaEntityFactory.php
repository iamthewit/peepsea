<?php

namespace Factory;

use Entity\PeepSeaEntity;
use PeepSea\Guess;
use PeepSea\PeepSea;

class PeepSeaEntityFactory
{
    public static function buildEntityFromPeepSea(PeepSea $peepSea)
    {
        $guesses = [];
        foreach ($peepSea->guesses() as $guess) {
            /** @var Guess $guess */
            $guesses[] = [
                'text' => $guess->text(),
                'guesser' => $guess->guesser()->name()
            ];
        }

        return new PeepSeaEntity(
            $peepSea->answer(),
            $peepSea->images()->toArray(),
            $guesses
        );
    }

    public static function buildEntityFromDatabaseRow(array $row)
    {
        /**
         * answer - string
         * images - string, comma delimited
         * guesses - string, json ( {[{text: 'Guess Text', guesser: 'Guesser Name'}]} )
         */

        return new PeepSeaEntity(
            $row['answer'],
            explode(',', $row['images']),
            json_decode($row['guesses'])
        );
    }
}