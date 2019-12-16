<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Service;

use App\Bundle\DownloadBundle\Converter\WebsiteConverter;
use App\Bundle\DownloadBundle\DTO\ElementDTO;
use App\Bundle\DownloadBundle\Generator\ElementPhotoGenerator;
use App\Bundle\DownloadBundle\Transformer\ContentPhotoTransformer;
use App\Bundle\DownloadBundle\Validator\PhotoElementLinkValidator;
use PHPHtmlParser\Dom;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class DownloadPhotoService
{
    /** @var ContentPhotoTransformer */
    private $contentPhotoTransformer;
    
    /** @var ElementPhotoGenerator */
    private $elementPhotoGenerator;
    
    /** @var WebsiteConverter */
    private $websiteConverter;
    
    /** @var PhotoElementLinkValidator */
    private $photoElementLinkValidator;
    
    /**
     * @param ContentPhotoTransformer   $contentPhotoTransformer
     * @param ElementPhotoGenerator     $elementPhotoGenerator
     * @param PhotoElementLinkValidator $photoElementLinkValidator
     * @param WebsiteConverter          $websiteConverter
     */
    public function __construct(
        ContentPhotoTransformer $contentPhotoTransformer,
        ElementPhotoGenerator $elementPhotoGenerator,
        PhotoElementLinkValidator $photoElementLinkValidator,
        WebsiteConverter $websiteConverter
    )
    {
        $this->contentPhotoTransformer = $contentPhotoTransformer;
        $this->elementPhotoGenerator = $elementPhotoGenerator;
        $this->websiteConverter = $websiteConverter;
        $this->photoElementLinkValidator = $photoElementLinkValidator;
    }
    
    /**
     * @param string     $address
     * @param ElementDTO $elementDTO
     */
    public function getPhotos(string $address, ElementDTO $elementDTO): void
    {
        $website = $this->websiteConverter->convert($address, $elementDTO->getLink());
        
        if ($this->photoElementLinkValidator->validate($website)) {
            $dom = new Dom;
            $dom->setOptions([
                'removeScripts' => false
            ]);
            $dom->loadFromUrl($website);
        } else {
            $dom = null;
        }

        $elementPhotoDTOCollection = $this->contentPhotoTransformer->transform($dom, $elementDTO, $website);
            
        $this->elementPhotoGenerator->generatePhotos($elementDTO, $elementPhotoDTOCollection);
    }
}
