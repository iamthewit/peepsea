<?php

namespace Repository;

use Application\Exception\PeepSeaEntityCollectionCreationException;
use Entity\PeepSeaEntity;
use Entity\PeepSeaEntityCollection;
use Factory\PeepSeaEntityFactory;
use PDO;

class SQLPeepSeaRepository implements PeepSeaRepositoryInterface
{
    private PDO $host;

    /**
     * SQLPeepSeaRepository constructor.
     * @param PDO $host
     */
    public function __construct(PDO $host)
    {
        $this->host = $host;
        // set error mode: https://phpdelusions.net/pdo#errors
        $this->host->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }

    /**
     * @param string $id
     * @return PeepSeaEntity|null
     */
    public function findById(string $id): ?PeepSeaEntity
    {
        if (!$this->exists($id)) {
            return null;
        }

        $statement = $this->host->prepare("SELECT * FROM `peepsea` WHERE `id` = :id");
        $statement->bindParam(':id', $id);
        $statement->execute();

        $databaseRow = $statement->fetch();

        // TODO: handle case where we can't find a peepsea by id

        return PeepSeaEntityFactory::buildEntityFromDatabaseRow($databaseRow);
    }

    /**
     * @param PeepSeaEntity $peepSeaEntity
     */
    public function store(PeepSeaEntity $peepSeaEntity): void
    {
        $sql = "INSERT INTO `peepsea` (`id`, `answer`, `images`, `guesses`) VALUES (:id, :answer, :images, :guesses)";

        // check if row exists
        if ($this->exists($peepSeaEntity->getId())) {
            $sql = "UPDATE `peepsea` SET `answer` = :answer, `images` = :images, `guesses` = :guesses WHERE `id` = :id";
        }

        $statement = $this->host->prepare($sql);
        $statement->execute([
            'id' => $peepSeaEntity->getId(),
            'answer' => $peepSeaEntity->getAnswer(),
            'images' => implode(',', $peepSeaEntity->getImages()),
            'guesses' => json_encode($peepSeaEntity->getGuesses())
        ]);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function exists(string $id): bool
    {
        $sql = "SELECT count(`id`) FROM `peepsea` WHERE `id` = :id";
        $statement = $this->host->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        return (bool) $statement->fetch()['count(`id`)'];
    }

    /**
     * @return PeepSeaEntityCollection
     * @throws \Exception\PeepSeaEntityCollectionCreationException
     */
    public function all(): PeepSeaEntityCollection
    {
        $sql = "SELECT * FROM `peepsea`";
        $statement = $this->host->prepare($sql);
        $statement->execute();

        $results = [];
        foreach ($statement->fetchAll() as $result) {
            $results[] = PeepSeaEntityFactory::buildEntityFromDatabaseRow($result);
        }

        return new PeepSeaEntityCollection($results);
    }
}