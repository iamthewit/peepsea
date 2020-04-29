<?php


namespace Application;


use Exception\GuessesCreationException;
use Exception\ImagesCreationException;
use Exception\PeepSeaDoesNotExistException;
use Factory\PeepSeaCollectionFactory;
use Factory\PeepSeaEntityFactory;
use Factory\PeepSeaFactory;
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

    private function createArrayOfImages(array $imagePaths)
    {
        $images = [];
        foreach ($imagePaths as $imagePath) {
            $images[] = new Image($imagePath);
        }

        return new Images($images);
    }
}