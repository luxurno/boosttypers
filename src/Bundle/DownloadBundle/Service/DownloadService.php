<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Service;

use App\Bundle\DownloadBundle\Generator\ElementGenerator;
use App\Bundle\DownloadBundle\Transformer\ContentTransformer;
use App\Bundle\DownloadBundle\Service\DownloadPhotoElementService;
use PHPHtmlParser\Dom;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class DownloadService
{
    /** @var ContentTransformer */
    private $contentTransformer;
    
    /** @var ElementGenerator */
    private $elementGenerator;
    
    /** @var DownloadPhotoElementService */
    private $downloadPhotoElementService;
    
    /**
     * @param ContentTransformer $contentTransformer
     */
    public function __construct(
        ContentTransformer $contentTransformer,
        ElementGenerator $elementGenerator,
        DownloadPhotoElementService $downloadPhotoElementService
    )
    {
        $this->contentTransformer = $contentTransformer;
        $this->elementGenerator = $elementGenerator;
        $this->downloadPhotoElementService = $downloadPhotoElementService;
    }
    
    /**
     * @param string $address
     */
    public function download(string $address): void
    {
        $dom = new Dom;
        $dom->loadFromUrl($address);
        
        $collection = $this->contentTransformer->transform($dom);
        
        foreach ($collection->getIterator() as $elementDTO) {
            $this->downloadPhotoElementService->getPhotos($address, $elementDTO->getLink());
            //$this->elementGenerator->generate($elementDTO);
        }
        echo "Kuniec";
        die;
    }
}
