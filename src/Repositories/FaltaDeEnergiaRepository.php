<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use Doctrine\DBAL\Connection;

class FaltaDeEnergiaRepository extends AbstractRepository
{
    /**
     * @var Connection
     */
    protected $connection;

    protected $tableName = 'faltas_de_energia';

    public function find(int $id)
    {

    }

    public function findAll()
    {
        $faltasDeEnergia = $this->connection->createQueryBuilder()
            ->select('*')
            ->from($this->getTableName(), 'fde')
            ->execute()
            ->fetchAll();

        if (empty($faltasDeEnergia)) {
            throw new NotFoundException('Nenhum registro de falta de energia encontrado');
        }
 
        return $faltasDeEnergia;
    }
}
