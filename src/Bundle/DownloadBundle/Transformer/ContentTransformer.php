<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Transformer;

use App\Bundle\DownloadBundle\Collection\ElementDTOCollection;
use App\Bundle\DownloadBundle\Factory\ElementDTOFactory;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ContentTransformer
{
    /** @var ElementDTOFactory */
    private $elementDTOFactory;
    
    /**
     * @param ElementDTOFactory $elementDTOFactory
     */
    public function __construct(ElementDTOFactory $elementDTOFactory)
    {
        $this->elementDTOFactory = $elementDTOFactory;
    }
    
    /**
     * @param array $links
     * @return ElementDTOCollection
     */
    public function transform(array $links): ElementDTOCollection
    {
        $array = [];
        foreach ($links as $link) {
            $elementDTO = $this->elementDTOFactory->factory();

            $elementDTO->setLink($link['link']);
            $elementDTO->setTitle($link['title']);
            $elementDTO->setDate($link['date']);
            $array[] = $elementDTO;
        }
        
        return new ElementDTOCollection(... $array);
    }
}
