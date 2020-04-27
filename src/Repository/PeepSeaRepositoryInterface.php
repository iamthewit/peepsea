<?php

namespace Repository;

use Entity\PeepSeaEntity;

interface PeepSeaRepositoryInterface
{
    public function findById(string $id): PeepSeaEntity;

    public function store(PeepSeaEntity $peepSeaEntity): void;

    public function exists(string $id): bool;
}