<?php

declare(strict_types = 1);

namespace App\Core\Finder;

use Doctrine\DBAL\Statement;
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
     */
    public function executeSelectStatment(Select $query): array
    {
        $this->statment = $this->em->getConnection()->prepare($query);
        $this->bindValues();
        
        $this->statment->execute();
        
//        echo "</br>Wrapped: </br>";
//        print_r($this->statment->getWrappedStatement());
//        
//        echo "</br>ErrorCode: </br>";
//        print_r($this->statment->errorCode());
//        
//        echo "</br>ErrorStatment</br>";
//        print_r($this->statment->errorInfo());
//        
//        echo "Fetched:<br/>";
//        print_r($this->statment->fetchAll());
//        
        return $this->statment->fetchAll();
    }
    
    private function bindValues()
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
