<?php

namespace Application\API;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;

class HomeController
{
    public function index(RequestInterface $request)
    {
        $bodyContent = json_encode([
            'message' => 'PeepSea'
        ]);
        return new Response(
            200,
            ['Content-Type' => 'application/json'],
            $bodyContent
        );
    }
}