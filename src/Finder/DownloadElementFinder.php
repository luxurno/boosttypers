<?php

declare(strict_types = 1);

namespace App\Finder;

use App\Bundle\DownloadBundle\Entity\Element;
use App\Core\Finder\AbstractFinder;
use Doctrine\ORM\EntityManagerInterface;
use NilPortugues\Sql\QueryBuilder\Syntax\OrderBy;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class DownloadElementFinder extends AbstractFinder
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
        array $criteria,
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
        
        if (null !== $limit) {
            $query->limit(0, (int)$limit);
        }
        
        return $this->executeSelectStatment($query);
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
