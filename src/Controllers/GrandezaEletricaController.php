<?php

namespace App\Controllers;

use App\Services\GrandezaEletricaService;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GrandezaEletricaController extends AbstractController
{
    /**
     * @var GrandezaEletricaService
     */
    protected $service;

    public function create(ServerRequestInterface $request, ResponseInterface $response)
    {
        try {

        } catch(Exception $exception) {

        }
    }
}
