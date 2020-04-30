<?php

namespace Application\API;

use Application\PeepSeaService;
use Exception\PeepSeaDoesNotExistException;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PeepSeaController
{
    private PeepSeaService $peepSeaService;

    /**
     * PeepSeaController constructor.
     * @param PeepSeaService $peepSeaService
     */
    public function __construct(PeepSeaService $peepSeaService)
    {
        $this->peepSeaService = $peepSeaService;
    }

    public function list(ServerRequestInterface $request)
    {
        return new Response(
            200,
            ['Content-Type' => 'application/json'],
            json_encode($this->peepSeaService->fetchAll())
        );
    }

    public function show($id, ServerRequestInterface $request)
    {
        try {
            $bodyContent = $this->peepSeaService->findById($id);
        } catch (PeepSeaDoesNotExistException $e) {
            return new Response(404, [], '404');
        }

        return new Response(
            200,
            ['Content-Type' => 'application/json'],
            json_encode($bodyContent)
        );
    }

    public function create(ServerRequestInterface $request)
    {
        // TODO: validate $request->getParsedBody()

        $peepSea = $this->peepSeaService->create(
            $request->getParsedBody()['answer'],
            $request->getParsedBody()['images']
        );

        return new Response(
            201,
            ['Content-Type' => 'application/json'],
            json_encode($peepSea)
        );
    }

    public function update()
    {

    }

    public function delete()
    {

    }


}