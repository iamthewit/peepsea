<?php


use Entity\PeepSeaEntity;
use Repository\SQLPeepSeaRepository;
use PHPUnit\Framework\TestCase;

class SQLPeepSeaRepositoryTest extends TestCase
{
    private PDO $pdo;

    public function setUp(): void
    {
        $this->pdo = new PDO('sqlite::memory:');
//        $this->pdo = new PDO('sqlite:/home/ben/peepsea.sqlite3');

        // migrate DB
        $migrations = file_get_contents(__DIR__ . '/../../database/migrations.sql');
        $this->pdo->exec($migrations);
    }

    public function testItStoresAPeepSeaEntity()
    {
        $repository = new SQLPeepSeaRepository($this->pdo);
        $repository->store(
            new PeepSeaEntity(
                '123',
                'Answer Text',
                ['image1.png'],
                ['guess1']
            )
        );

        $sql = "SELECT * FROM `peepsea` WHERE `id` = :id AND `answer` = :answer AND `images` = :images AND `guesses` = :guesses";

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', '123');
        $statement->bindValue(':answer', 'Answer Text');
        $statement->bindValue(':images', 'image1.png');
        $statement->bindValue(':guesses', json_encode(['guess1']));
        $statement->execute();

        $result = $statement->fetch();

        $this->assertEquals('123', $result['id']);
        $this->assertEquals('Answer Text', $result['answer']);
        $this->assertEquals('image1.png', $result['images']);
        $this->assertEquals(json_encode(['guess1']), $result['guesses']);
    }

    public function testExists()
    {
        $repository = new SQLPeepSeaRepository($this->pdo);
        $repository->store(
            new PeepSeaEntity(
                '123',
                'Answer Text',
                ['image1.png'],
                ['guess1']
            )
        );

        $this->assertTrue($repository->exists('123'));
    }

    public function testFindById()
    {
        $repository = new SQLPeepSeaRepository($this->pdo);
        $repository->store(
            new PeepSeaEntity(
                '123',
                'Answer Text',
                ['image1.png'],
                ['guess1']
            )
        );

        $peepSeaEntity = $repository->findById('123');

        $this->assertInstanceOf(PeepSeaEntity::class, $peepSeaEntity);
        $this->assertEquals('123', $peepSeaEntity->getId());
    }
}
