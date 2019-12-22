<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Generator;

use App\Bundle\DownloadBundle\Collection\ElementPhotoDTOCollection;
use App\Bundle\DownloadBundle\DTO\ElementDTO;
use App\Bundle\DownloadBundle\Generator\Command\SaveElementPhotoCommand;
use App\Bundle\DownloadBundle\Repository\ElementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use SimpleBus\SymfonyBridge\Bus\CommandBus;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ElementPhotoGenerator
{
    /** @var EntityManagerInterface */
    private $em;

    /** @var ElementRepository */
    private $elementRepository;

    /** @var CommandBus */
    private $commandBus;
    
    /**
     * @param EntityManagerInterface $em
     * @param ElementRepository      $elementRepository
     * @param CommandBus             $commandBus
     */
    public function __construct(
        EntityManagerInterface $em,
        ElementRepository $elementRepository,
        CommandBus $commandBus
    )
    {
        $this->em = $em;
        $this->elementRepository = $elementRepository;
        $this->commandBus = $commandBus;
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
        $elementEntity = $this->elementRepository->findOneBy(['id' => $elementDTO->getId()]);
        $elementEntity->setIsVideo($elementDTO->getIsVideo());
        $elementEntity->setPhotoNumber($elementDTO->getPhotoNumber());
        $this->em->persist($elementEntity);
        $this->em->flush();

        foreach ($elementPhotoDTOCollection->getIterator() as $elementPhotoDTO) {
            $this->commandBus->handle(new SaveElementPhotoCommand($elementDTO, $elementPhotoDTO));
        }
    }

}
