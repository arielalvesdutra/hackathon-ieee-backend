<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use Doctrine\DBAL\Connection;

class GrandezaEletricaRepository extends AbstractRepository
{
    /**
     * @var Connection
     */
    protected $connection;

    protected $tableName = 'grandezas_eletricas';

    public function find(int $id)
    { }

    public function findAll()
    {
        $grandezasEletricas = $this->connection->createQueryBuilder()
            ->select('*')
            ->from($this->getTableName(), 'ge')
            ->execute()
            ->fetchAll();

        if (empty($grandezasEletricas)) {
            throw new NotFoundException('Nenhum registro de grandeza elétrica encontrado');
        }

        return $grandezasEletricas;
    }

    public function findBetweenInitAndFinalDate(string $initDate, string $finalDate)
    {
        $grandezasEletricas = $this->connection->createQueryBuilder()
            ->select('*')
            ->from($this->getTableName(), 'ge')
            ->where('ge.data_criacao >= :initDate')
            ->setParameter(':initDate', $initDate)
            ->andWhere('ge.data_criacao <= :finalDate')
            ->setParameter(':finalDate', $finalDate)
            ->execute()
            ->fetchAll();

        if (empty($grandezasEletricas)) {
            throw new NotFoundException('Nenhum registro de grandeza elétrica encontrado');
        }

        return $grandezasEletricas;
    }
}
