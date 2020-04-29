<?php

namespace Application\API;

use Application\FetchAllPeepSea;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Repository\PeepSeaRepositoryInterface;

class PeepSeaController
{
    private PeepSeaRepositoryInterface $repository;

    /**
     * PeepSeaController constructor.
     * @param PeepSeaRepositoryInterface $repository
     */
    public function __construct(PeepSeaRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function list(RequestInterface $request)
    {
        // TODO: refactor all application classes into a PeepSeaService class
        // and inject into the controller
        $fetchAllPeepSea = new FetchAllPeepSea($this->repository);

        return new Response(
            200,
            ['Content-Type' => 'application/json'],
            json_encode($fetchAllPeepSea->fetchAll())
        );
    }

    public function show($id, RequestInterface $request)
    {
        // TODO: create FindPeepSeaById class
        $bodyContent = json_encode($this->repository->findById($id));

        return new Response(
            200,
            ['Content-Type' => 'application/json'],
            $bodyContent
        );

    }

    public function create(ServerRequestInterface $request)
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }


}