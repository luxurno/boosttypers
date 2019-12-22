<?php

namespace App\Bundle\DownloadBundle\Finder;

use App\Bundle\DownloadBundle\Repository\ElementRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ElementFinder
{
    /** @var ElementRepository */
    protected $elementRepository;

    /** @var array */
    protected $columns = [
        'de.id',
        'de.title',
        'de.link',
    ];

    public function __construct(ElementRepository $elementRepository)
    {
        $this->elementRepository = $elementRepository;
    }

    public function findMissingPhotos(): array
    {
        $qb = $this->elementRepository->createQueryBuilder($this->getAlias());
        $qb->select($this->columns)
            ->where('de.photoNumber is null');

        return $qb->getQuery()->getResult();
    }

    public function getAlias(): string
    {
        return 'de';
    }
}