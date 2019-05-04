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
        $grandeza = $this->connection->createQueryBuilder()
            ->select('*')
            ->from($this->getTableName(), 'ge')
            ->execute()
            ->fetchAll();

        if (empty($grandeza)) {
            throw new NotFoundException('Nenhum registro de categoria de atendimento encontrado');
        }
 
        return $grandeza;

    }
}
