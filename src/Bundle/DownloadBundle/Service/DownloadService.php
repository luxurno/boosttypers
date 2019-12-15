<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Service;

use App\Bundle\DownloadBundle\Transformer\ContentTransformer;
use PHPHtmlParser\Dom;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class DownloadService
{
    /** @var ContentTransformer */
    private $contentTransformer;
    
    /**
     * @param ContentTransformer $contentTransformer
     */
    public function __construct(ContentTransformer $contentTransformer)
    {
        $this->contentTransformer = $contentTransformer;
    }
    
    /**
     * @param string $address
     */
    public function download(string $address)
    {
        $dom = new Dom;
        $dom->loadFromUrl($address);
        
        $content = $this->contentTransformer->transform($dom);
    }
}
