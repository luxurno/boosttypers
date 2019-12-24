<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Generator\Handler;

use App\Bundle\DownloadBundle\Entity\Element;
use App\Bundle\DownloadBundle\Factory\ElementFactory;
use App\Bundle\DownloadBundle\Generator\Command\SaveElementCommand;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class SaveElementHandler
{
    /** @var EntityManagerInterface */
    private $em;

    /** @var ElementFactory */
    private $elementFactory;

    public function __construct(
        EntityManagerInterface $em,
        ElementFactory $elementFactory
    )
    {
        $this->em = $em;
        $this->elementFactory = $elementFactory;
    }

    public function handle(SaveElementCommand $saveElementCommand): void
    {
        $elementDTO = $saveElementCommand->getElementDTO();

        $elementEntity = $this->elementFactory->factory();
        $elementEntity->setLink($elementDTO->getLink());
        $elementEntity->setTitle($elementDTO->getTitle());
        $elementEntity->setDate($elementDTO->getDate());
        $this->em->persist($elementEntity);
        $this->em->flush();
    }
}
