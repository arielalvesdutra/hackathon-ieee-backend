<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Factories\Entities\GrandezaEletricaEntityFactory;
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
    }
}
