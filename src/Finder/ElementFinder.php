<?php

declare(strict_types = 1);

namespace App\Finder;

use App\Bundle\DownloadBundle\Entity\Element;
use App\Core\Finder\AbstractFinder;
use Doctrine\ORM\EntityManagerInterface;
use NilPortugues\Sql\QueryBuilder\Syntax\OrderBy;
use PDO;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ElementFinder extends AbstractFinder
{
    /** @var array */
    protected $columns = [
        'id',
        'link',
        'title',
    ];
    
    public function __construct(
        EntityManagerInterface $em
    )
    {
        parent::__construct($em);
    }
    
    public function findByCriteria(
        ?array $criteria,
        ?int $limit,
        ?string $sortBy,
        ?string $sortTypeBy = 'ASC'
    ): array
    {
        $query = $this->queryBuilder->select()
            ->setTable($this->getTableName());
        
        if (null !== $sortBy) {
            $query->orderBy($sortBy, $sortTypeBy);
        }
        
        // Issue, so slice is required
        // I throught about forking library, but this is kinda hotfix
        // https://github.com/nilportugues/php-sql-query-builder/issues/105
        $data = $this->executeSelectStatment($query);
        
        if (null !== $limit) {
            $data = array_slice($data, 0, $limit);
        }
        
        return $data;
    }
    
    public function getTableName(): string
    {
        return 'download_element';
    }
    
    public function getAlias(): string
    {
        return 'de';
    }
}
