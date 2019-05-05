<?php

namespace App\Controllers;

use App\Services\GrandezaEletricaService;
use Exception;
use App\Exceptions\NotFoundException;
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
            $parameters = $request->getParsedBody();

            $this->service->createGrandezaEletrica($parameters);

            return $response->withStatus(201);
        } catch (Exception $exception) {
            return $response->withJson($exception->getMessage(), $exception->getCode()());
        }
    }

    public function retrieveAll(ServerRequestInterface $request, ResponseInterface $response)
    {
        try {

            $grandezasEletricas = $this->service->retrieveAllGrandezasEletricas();

            return $response->withJson($grandezasEletricas, 200);
        } catch (Exception $exception) {
            return $response->withJson($exception->getMessage(), $exception->getCode()());
        }
    }

    public function search(ServerRequestInterface $request, ResponseInterface $response)
    { 
        try {

            $parameters = $request->getQueryParams();
            
            $grandezasEletricas = $this->service->searchGrandezasEletricas($parameters);

            return $response->withJson($grandezasEletricas, 200);
        } catch (Exception $exception) {
            return $response->withJson($exception->getMessage(), $exception->getCode());
        }
    }
}
