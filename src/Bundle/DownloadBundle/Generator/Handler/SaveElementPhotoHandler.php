<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Generator\Handler;

use App\Bundle\DownloadBundle\Entity\ElementPhoto;
use App\Bundle\DownloadBundle\Generator\Command\SaveElementPhotoCommand;
use App\Bundle\DownloadBundle\Repository\ElementRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class SaveElementPhotoHandler
{
    /** @var EntityManagerInterface */
    private $em;

    /** @var ElementRepository */
    private $elementRepository;

    public function __construct(
        EntityManagerInterface $em,
        ElementRepository $elementRepository
    )
    {
        $this->em = $em;
        $this->elementRepository = $elementRepository;
    }

    public function handle(SaveElementPhotoCommand $saveElementPhotoCommand): void
    {
        $elementDTO = $saveElementPhotoCommand->getElementDTO();
        $elementPhotoDTO = $saveElementPhotoCommand->getElementPhotoDTO();
        $elementEntity = $this->elementRepository->findOneBy(['id' => $elementDTO->getId()]);

        $elementPhotoEntity = new ElementPhoto();
        $elementPhotoEntity->setHref($elementPhotoDTO->getHref());
        $elementEntity->addPhoto($elementPhotoEntity);
        $this->em->persist($elementPhotoEntity);
        $this->em->persist($elementEntity);
        $this->em->flush();
    }
}
