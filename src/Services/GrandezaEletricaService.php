<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Formatters\Formatter;
use App\Repositories\GrandezaEletricaRepository;
use Doctrine\DBAL\Connection;
use Exception;
use InvalidArgumentException;

class GrandezaEletricaService
{
    protected $connection;

    protected $repository;

    public function __construct(Connection $connection,
    GrandezaEletricaRepository $repository)
    {
        $this->connection = $connection;
        $this->repository = $repository;
    }

    public function createGrandezaEletrica(array $parameters)
    {
        if (
            empty($parameters['sn']) ||
            empty($parameters['tensao']) ||
            empty($parameters['corrente']) ||
            empty($parameters['potenciaAparente']) ||
            empty($parameters['potenciaAtiva']) ||
            empty($parameters['potenciaReativa']) ||
            empty($parameters['fatorPotencia']) ||
            empty($parameters['energiaAcumulada']) ||
            empty($parameters['dataCriacao'])
        ) {
            throw new Exception('Parâmetros necessários não preenchidos', 400);
        }

        $this->connection->beginTransaction();

        $this->connection->insert(
            $this->repository->getTableName(),
            [
                'sn' => $parameters['sn'],
                'tensao' => $parameters['tensao'],
                'corrente' => $parameters['corrente'],
                'potencia_aparente' => $parameters['potenciaAparente'],
                'potencia_ativa' => $parameters['potenciaAtiva'],
                'potencia_reativa' => $parameters['potenciaReativa'],
                'fator_potencia' => $parameters['fatorPotencia'],
                'energia_acumulada' => $parameters['energiaAcumulada'],
                'data_criacao' => $parameters['dataCriacao']
            ]
        );

        $this->connection->commit();
    }

    public function retrieveAllGrandezasEletricas()
    {
        $grandezasEletricas =  $this->repository->findAll();

        return $grandezasEletricas;
    }

    public function searchGrandezasEletricas(array $parameters)
    {
        // return $parameters;
        $grandezasEletricas = $this->repository->findBetweenInitAndFinalDate(
            $parameters['initDate'],
            $parameters['finalDate']
        );

        return $grandezasEletricas;
    }
}
