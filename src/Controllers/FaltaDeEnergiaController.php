<?php

namespace App\Controllers;

use App\Services\FaltaDeEnergiaService;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FaltaDeEnergiaController extends AbstractController
{
    /**
     * @var FaltaDeEnergiaService
     */
    protected $service;

    public function create(ServerRequestInterface $request, ResponseInterface $response)
    {
        try {

            $parameters = $request->getParsedBody();

            $this->service->createFaltaDeEnergia($parameters);

            return $response->withStatus(201);

        } catch(Exception $exception) {
            return $response->withJson($exception->getMessage(), $exception->getCode());
        }
    }

    public function retrieveAll(ServerRequestInterface $request, ResponseInterface $response)
    {
        
        try {

            $faltasDeEnergia = $this->service->retrieveAllFaltasDeEnergia();

            return $response->withJson($faltasDeEnergia, 200);

        } catch(Exception $exception) {
            return $response->withJson($exception->getMessage(), $exception->getCode());
        }
    }
}
