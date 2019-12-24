<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Transformer;

use App\Bundle\DownloadBundle\Collection\ElementPhotoDTOCollection;
use App\Bundle\DownloadBundle\Factory\ElementPhotoDTOFactory;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ContentPhotoTransformer
{
    /** @var ElementPhotoDTOFactory */
    private $elementPhotoDTOFactory;
    
    /**
     * @param ElementPhotoDTOFactory $elementPhotoDTOFactory
     */
    public function __construct(ElementPhotoDTOFactory $elementPhotoDTOFactory)
    {
        $this->elementPhotoDTOFactory = $elementPhotoDTOFactory;
    }

    /**
     * @param array $photos
     * @return ElementPhotoDTOCollection
     */
    public function transform(array $photos): ElementPhotoDTOCollection
    {
        $array = [];
        foreach ($photos as $photo) {
            $elementPhotoDTO = $this->elementPhotoDTOFactory->factory();
            $elementPhotoDTO->setHref($photo);
            $array[] = $elementPhotoDTO;
        }
        
        return new ElementPhotoDTOCollection(... $array);
    }
    
}
