<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Service;

use App\Bundle\DownloadBundle\Generator\ElementGenerator;
use App\Bundle\DownloadBundle\Transformer\ContentTransformer;
use App\Bundle\DownloadBundle\Service\DownloadPhotoService;
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
    
    /** @var DownloadPhotoService */
    private $downloadPhotoService;
    
    /**
     * @param ContentTransformer   $contentTransformer
     * @param ElementGenerator     $elementGenerator
     * @param DownloadPhotoService $downloadPhotoService
     */
    public function __construct(
        ContentTransformer $contentTransformer,
        ElementGenerator $elementGenerator,
        DownloadPhotoService $downloadPhotoService
    )
    {
        $this->contentTransformer = $contentTransformer;
        $this->elementGenerator = $elementGenerator;
        $this->downloadPhotoService = $downloadPhotoService;
    }
    
    /**
     * @param string $address
     * @param int    $count
     */
    public function download(string $address, int $count): void
    {
        $dom = new Dom;
        $dom->loadFromUrl($address);
        
        $collection = $this->contentTransformer->transform($dom, $count);
        foreach ($collection->getIterator() as $elementDTO) {
            $this->elementGenerator->generate($elementDTO);
            $this->downloadPhotoService->getPhotos($address, $elementDTO);
        }
    }
}
