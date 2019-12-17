<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Generator;

use App\Bundle\DownloadBundle\DTO\ElementDTO;
use App\Bundle\DownloadBundle\Entity\Element;
use App\Bundle\DownloadBundle\Validator\ElementValidator;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ElementGenerator
{
    /** @var EntityManagerInterface */
    private $em;
    
    /** @var ElementValidator */
    private $elementValidator;
    
    public function __construct(
        EntityManagerInterface $em,
        ElementValidator $elementValidator
    )
    {
        $this->em = $em;
        $this->elementValidator = $elementValidator;
    }
    
    /**
     * @param ElementDTO $elementDTO
     */
    public function generate(ElementDTO $elementDTO): void
    {
        if ($this->elementValidator->validate($elementDTO)) {
            $elementEntity = new Element();
            $elementEntity->setLink($elementDTO->getLink());
            $elementEntity->setTitle($elementDTO->getTitle());
            $this->em->persist($elementEntity);
            $this->em->flush();
        }
    }
}
