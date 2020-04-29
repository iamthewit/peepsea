<?php

namespace Application;

use PeepSea\Guesses;
use Exception\GuessesCreationException;
use PeepSea\Images;
use Exception\ImagesCreationException;
use PeepSea\PeepSea;
use Factory\PeepSeaEntityFactory;
use Ramsey\Uuid\Uuid;
use Repository\PeepSeaRepositoryInterface;

class CreatePeepSea
{
    private PeepSeaRepositoryInterface $peepSeaRepository;

    public function __construct(PeepSeaRepositoryInterface $peepSeaRepository)
    {
        $this->peepSeaRepository = $peepSeaRepository;
    }

    /**
     * @param string $answer
     * @param array $images
     * @return PeepSea
     * @throws GuessesCreationException
     * @throws ImagesCreationException
     */
    public function create(string $answer, array $images): PeepSea
    {
        // create new PeepSea
        $peepSea = new PeepSea(
            Uuid::uuid4(),
            $answer,
            new Images($images),
            new Guesses([])
        );

        // store PeepSea
        $this->peepSeaRepository->store(PeepSeaEntityFactory::buildEntityFromPeepSea($peepSea));

        return $peepSea;
    }
}