<?php

namespace Application\API;

use Application\PeepSeaService;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GuessController
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

    public function create($id, ServerRequestInterface $request)
    {
        // TODO: validate $request->getParsedBody()

        $guess = $this->peepSeaService->guess(
            $id,
            $request->getParsedBody()['guess'],
            $request->getParsedBody()['guesser']
        );

        return new Response(
            201,
            ['Content-Type' => 'application/json'],
            json_encode($guess)
        );
    }
}