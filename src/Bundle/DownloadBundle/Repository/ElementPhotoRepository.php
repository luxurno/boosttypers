<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Repository;

use App\Bundle\DownloadBundle\Entity\ElementPhoto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ElementPhotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ElementPhoto::class);
    }
}
