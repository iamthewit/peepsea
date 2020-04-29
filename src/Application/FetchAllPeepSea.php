<?php

namespace Application;

use Factory\PeepSeaCollectionFactory;
use PeepSea\PeepSeaCollection;
use Repository\PeepSeaRepositoryInterface;

class FetchAllPeepSea
{
    private PeepSeaRepositoryInterface $repository;

    /**
     * FetchAllPeepSea constructor.
     * @param PeepSeaRepositoryInterface $repository
     */
    public function __construct(PeepSeaRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return PeepSeaCollection
     */
    public function fetchAll(): PeepSeaCollection
    {
        $peepSeaEntityCollection = $this->repository->all();
//        d($peepSeaEntityCollection);

        return PeepSeaCollectionFactory::buildFromPeepSeaEntityCollection($peepSeaEntityCollection);
    }
}