<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Generator;

use App\Bundle\DownloadBundle\Collection\ElementPhotoDTOCollection;
use App\Bundle\DownloadBundle\DTO\ElementDTO;
use App\Bundle\DownloadBundle\Entity\ElementPhoto;
use App\Bundle\DownloadBundle\Repository\ElementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ElementPhotoGenerator
{
    /** @var EntityManagerInterface */
    private $em;
    
    /** @var ElementRepository */
    private $elementRepository;
    
    /**
     * @param EntityManagerInterface $em
     * @param ElementRepository      $elementRepository
     */
    public function __construct(
        EntityManagerInterface $em,
        ElementRepository $elementRepository
    )
    {
        $this->em = $em;
        $this->elementRepository = $elementRepository;
    }

    /**
     * @param ElementDTO $elementDTO
     * @param ElementPhotoDTOCollection $elementPhotoDTOCollection
     * @throws Exception
     */
    public function generatePhotos(
        ElementDTO $elementDTO,
        ElementPhotoDTOCollection $elementPhotoDTOCollection
    ): void
    {
        $elementDTO->setPhotoNumber(count($elementPhotoDTOCollection));
        
        $elementEntity = $this->elementRepository->findOneBy(['link' => $elementDTO->getLink()]);
        $elementEntity->setIsVideo($elementDTO->getIsVideo());
        $elementEntity->setPhotoNumber($elementDTO->getPhotoNumber());
        
        foreach ($elementPhotoDTOCollection->getIterator() as $elementPhotoDTO) {
            $elementPhotoEntity = new ElementPhoto();
            $elementPhotoEntity->setHref($elementPhotoDTO->getHref());
            $elementEntity->addPhoto($elementPhotoEntity);
            $this->em->persist($elementPhotoEntity);
        }
        
        $this->em->persist($elementEntity);
        $this->em->flush();
    }
    
}
