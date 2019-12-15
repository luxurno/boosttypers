<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Repository;

use App\Bundle\DownloadBundle\Entity\Element;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ElementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Element::class);
    }
    
    /**
     * @return bool
     */
    public function exist(array $criteria): bool
    {
        if ($this->findOneBy($criteria)) {
            return true;
        } else {
            return false;
        }
    }
}
