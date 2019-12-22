<?php

declare(strict_types = 1);

namespace App\Finder;

use App\Bundle\DownloadBundle\Entity\Element;
use App\Core\Finder\AbstractFinder;
use App\Bundle\DownloadBundle\Repository\ElementPhotoRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ElementPhotoFinder extends AbstractFinder
{
    /** @var EntityManagerInterface */
    private $em;

    /** @var array */
    protected $columns = [
        
    ];
    
    public function __construct(
        EntityManagerInterface $em
    )
    {
        parent::__construct($em);
        
        $this->em = $em;
    }
    
    public function findByCriteria(
        ?array $criteria
    ): array
    {
        $query = $this->queryBuilder->select()
            ->setTable($this->getTableName());
        
        if (null !== $criteria) {
            $this->applyCriteria($query, $criteria);
        }

        return $this->executeSelectStatment($query);
    }
    
    protected function getTableName(): string
    {
        return 'download_element_photo';
    }
    
    protected function getAlias(): string
    {
        return 'dep';
    }
}
