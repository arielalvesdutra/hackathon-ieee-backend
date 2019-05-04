<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Factories\Entities\GrandezaEletricaEntityFactory;
use Doctrine\DBAL\Connection;

class GrandezaEletricaRespository extends AbstractRepository
{
    /**
     * @var Connection
     */
    protected $connection;

    protected $tableName = 'grandezas_eletricas';

    public function find(int $id)
    {

    }

    public function findAll()
    {

    }
}
