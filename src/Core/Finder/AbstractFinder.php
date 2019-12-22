<?php

declare(strict_types = 1);

namespace App\Core\Finder;

use Doctrine\DBAL\Statement;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManagerInterface;
use NilPortugues\Sql\QueryBuilder\Builder\GenericBuilder;
use NilPortugues\Sql\QueryBuilder\Manipulation\Select;
use PDO;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
abstract class AbstractFinder
{
    /** @var EntityManagerInterface */
    private $em;

    /** @var Statement */
    private $statment = '';

    /** @var GenericBuilder */
    protected $queryBuilder;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->statment = '';
        $this->em = $em;
        $this->queryBuilder = new GenericBuilder();
    }

    /**
     * @param Select $query
     * @return array
     * @throws DBALException
     */
    public function executeSelectStatment(Select $query): array
    {
        $this->statment = $this->em->getConnection()
            ->prepare($query);

        $this->bindValues();
        $this->statment->execute();

        return $this->statment->fetchAll();
    }

    /**
     * @param Select $query
     * @param array $criteria
     */
    protected function applyCriteria(Select $query, array $criteria): void
    {
        foreach ($criteria as $key => $value) {
            $query->where()
                ->equals($key, $value)
                ->end();
        }
    }

    private function bindValues(): void
    {
        foreach ($this->queryBuilder->getValues() as $key => $value) {
            if (is_numeric($value)) {
                $this->statment->bindParam($key, $value, PDO::PARAM_INT);
            } else {
                $this->statment->bindParam($key, $value, PDO::PARAM_STR);
            }
        }
    }
}