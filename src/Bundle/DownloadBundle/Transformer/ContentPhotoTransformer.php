<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Transformer;

use App\Bundle\DownloadBundle\Collection\ElementPhotoDTOCollection;
use App\Bundle\DownloadBundle\Collector\PhotoCollector;
use App\Bundle\DownloadBundle\DTO\ElementDTO;
use App\Bundle\DownloadBundle\Factory\ElementPhotoDTOFactory;
use App\Bundle\DownloadBundle\Provider\PhotoProvider;
use Exception;
use PHPHtmlParser\Dom;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ContentPhotoTransformer
{
    /** @var ElementPhotoDTOFactory */
    private $elementPhotoDTOFactory;
    
    /** @var PhotoCollector */
    private $photoCollector;
    
    /** @var PhotoConverter */
    private $photoProvider;
    
    /**
     * @param ElementPhotoDTOFactory $elementPhotoDTOFactory
     * @param PhotoCollector         $photoCollector
     * @param PhotoProvider          $photoProvider
     */
    public function __construct(
        ElementPhotoDTOFactory $elementPhotoDTOFactory,
        PhotoCollector $photoCollector,
        PhotoProvider $photoProvider
    )
    {
        $this->elementPhotoDTOFactory = $elementPhotoDTOFactory;
        $this->photoCollector = $photoCollector;
        $this->photoProvider = $photoProvider;
    }

    /**
     * @param ?Dom        $dom
     * @param ElementDTO $elementDTO
     * @param string $website
     * @return ElementPhotoDTOCollection
     * @throws Exception
     */
    public function transform(?Dom $dom, ElementDTO $elementDTO, string $website): ElementPhotoDTOCollection
    {
        $array = [];
        
        if ($dom !== null) {
            try {
                $photos = $dom->find("script",0)->innerhtml;
                $photos = $this->photoCollector->collect($photos);
                $photos = $this->photoProvider->provide($photos, $website);

                foreach ($photos as $photo) {
                    $elementPhotoDTO = $this->elementPhotoDTOFactory->factory();
                    $elementPhotoDTO->setHref($photo);
                    $array[] = $elementPhotoDTO;
                }
                $elementDTO->setIsVideo(true);
            } catch (Exception $ex) {
                echo "Problem with downloading photos: ";
                echo $ex->getMessage();
                throw $ex;
            }
        } else {
            $elementDTO->setIsVideo(true);
            $elementPhotoDTO = $this->elementPhotoDTOFactory->factory();
            $elementPhotoDTO->setHref($website);
            $array[] = $elementPhotoDTO;
        }
        
        
        return new ElementPhotoDTOCollection(... $array);
    }
    
}
