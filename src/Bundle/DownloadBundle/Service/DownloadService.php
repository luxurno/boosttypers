<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Service;

use App\Bundle\DownloadBundle\Exception\DownloadElementException;
use App\Bundle\DownloadBundle\Generator\ElementGenerator;
use App\Bundle\DownloadBundle\Transformer\ContentTransformer;
use PHPHtmlParser\Dom;
use Throwable;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class DownloadService
{
    /** @var ContentTransformer */
    private $contentTransformer;
    
    /** @var ElementGenerator */
    private $elementGenerator;
    
    /**
     * @param ContentTransformer   $contentTransformer
     * @param ElementGenerator     $elementGenerator
     */
    public function __construct(
        ContentTransformer $contentTransformer,
        ElementGenerator $elementGenerator
    )
    {
        $this->contentTransformer = $contentTransformer;
        $this->elementGenerator = $elementGenerator;
    }

    /**
     * @param string $address
     * @param int $count
     * @throws Throwable
     */
    public function download(string $address, int $count): void
    {
        try {
            $dom = new Dom;
            $dom->loadFromUrl($address);
        } catch(Throwable $e) {
            printf("Could not download Elements: %s", $e->getMessage());
            throw new DownloadElementException();
        }

        $collection = $this->contentTransformer->transform($dom, $count);
        foreach ($collection->getIterator() as $elementDTO) {
            $this->elementGenerator->generate($elementDTO);
        }
    }
}
