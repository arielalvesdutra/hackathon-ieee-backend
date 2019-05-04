<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Formatters\Formatter;
use App\Repositories\FaltaDeEnergiaRepository;
use Doctrine\DBAL\Connection;
use Exception;
use InvalidArgumentException;

class FaltaDeEnegiaService
{
    protected $connection;

    protected $repository;

    public function __construct(Connection $connection,
    FaltaDeEnergiaRepository $repository)
    {
        $this->connection = $connection;
        $this->repository = $repository;
    }

    public function createFaltaDeEnergia(array $parameters)
    {
        if (
            empty($parameters['sn'])
        ) {
            throw new Exception('Parâmetros necessários não preenchidos', 400);
        }

        $this->connection->beginTransaction();

        $this->connection->insert(
            $this->repository->getTableName(),
            [

            ]
        );

        $this->connection->commit();
    }
}
