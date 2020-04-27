<?php

namespace Application\API;

use Factory\PeepSeaEntityFactory;
use GuzzleHttp\Psr7\Response;
use PeepSea\Guesses;
use PeepSea\Image;
use PeepSea\Images;
use PeepSea\PeepSea;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Ramsey\Uuid\Uuid;
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
        $bodyContent = json_encode($this->repository->all());

        return new Response(
            200,
            ['Content-Type' => 'application/json'],
            $bodyContent
        );
    }

    public function show($id, RequestInterface $request)
    {
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