<?php

namespace Application;

use Exception\GuessesCreationException;
use Exception\ImagesCreationException;
use Exception\PeepSeaDoesNotExistException;
use Factory\PeepSeaCollectionFactory;
use Factory\PeepSeaEntityFactory;
use Factory\PeepSeaFactory;
use PeepSea\Guess;
use PeepSea\Guesser;
use PeepSea\Guesses;
use PeepSea\Image;
use PeepSea\Images;
use PeepSea\PeepSea;
use PeepSea\PeepSeaCollection;
use Ramsey\Uuid\Uuid;
use Repository\PeepSeaRepositoryInterface;

class PeepSeaService
{
    private PeepSeaRepositoryInterface $peepSeaRepository;

    public function __construct(PeepSeaRepositoryInterface $peepSeaRepository)
    {
        $this->peepSeaRepository = $peepSeaRepository;
    }

    /**
     * @param string $answer
     * @param array $imagePaths
     * @return PeepSea
     * @throws GuessesCreationException
     * @throws ImagesCreationException
     */
    public function create(string $answer, array $imagePaths): PeepSea
    {
        // create new PeepSea
        $peepSea = new PeepSea(
            Uuid::uuid4(),
            $answer,
            $this->createArrayOfImages($imagePaths),
            new Guesses([])
        );

        // store PeepSea
        $this->peepSeaRepository->store(PeepSeaEntityFactory::buildEntityFromPeepSea($peepSea));

        return $peepSea;
    }

    /**
     * @return PeepSeaCollection
     */
    public function fetchAll(): PeepSeaCollection
    {
        $peepSeaEntityCollection = $this->peepSeaRepository->all();

        return PeepSeaCollectionFactory::buildFromPeepSeaEntityCollection($peepSeaEntityCollection);
    }

    /**
     * @param string $id
     * @return PeepSea
     * @throws PeepSeaDoesNotExistException
     */
    public function findById(string $id): PeepSea
    {
        $peepSeaEntity = $this->peepSeaRepository->findById($id);

        if (is_null($peepSeaEntity)) {
            $m = sprintf(
                'No PeepSea with id: %s exists in the database.',
                $id
            );

            throw new PeepSeaDoesNotExistException($m);
        }

        return PeepSeaFactory::buildFromPeepSeaEntity($peepSeaEntity);
    }

    /**
     * @param string $id
     * @param string $text
     * @param string $guesserName
     * @return Guess
     * @throws GuessesCreationException
     * @throws PeepSeaDoesNotExistException
     */
    public function guess(string $id, string $text, string $guesserName): Guess
    {
        $peepSea = $this->findById($id);
        $guess = new Guess(new Guesser($guesserName), $text);
        $guesses = new Guesses(array_merge($peepSea->guesses()->toArray(), [$guess]));

        // TODO: update PeepSeaFactory with buildPeepSeaFromPeepSea
        // method can take a number of arguments to replace
        // existing PeepSea properties
        $peepSeaWithNewGuess = new PeepSea(
            $peepSea->id(),
            $peepSea->answer(),
            $peepSea->images(),
            $guesses
        );

        $peepSeaEntity = PeepSeaEntityFactory::buildEntityFromPeepSea($peepSeaWithNewGuess);
        $this->peepSeaRepository->store($peepSeaEntity);

        return $guess;
    }

    /**
     * @param array $imagePaths
     * @return Images
     * @throws ImagesCreationException
     */
    private function createArrayOfImages(array $imagePaths): Images
    {
        $images = [];
        foreach ($imagePaths as $imagePath) {
            $images[] = new Image($imagePath);
        }

        return new Images($images);
    }
}