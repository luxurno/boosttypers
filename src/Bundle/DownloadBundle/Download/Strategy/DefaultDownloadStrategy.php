<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Download\Strategy;

use App\Bundle\DownloadBundle\Collector\PhotoCollector;
use App\Bundle\DownloadBundle\Decoder\StringDecoder;
use App\Bundle\DownloadBundle\Exception\DownloadElementPhotosException;
use App\Bundle\DownloadBundle\Provider\PhotoProvider;
use PHPHtmlParser\Dom;
use Throwable;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class DefaultDownloadStrategy extends AbstractStrategy
{
    /** @var PhotoCollector */
    private $photoCollector;

    /** @var PhotoProvider */
    private $photoProvider;

    /** @var StringDecoder */
    private $stringDecoder;

    /**
     * @param PhotoCollector $photoCollector
     * @param PhotoProvider $photoProvider
     */
    public function __construct(
        PhotoCollector $photoCollector,
        PhotoProvider $photoProvider,
        StringDecoder $stringDecoder
    )
    {
        $this->photoCollector = $photoCollector;
        $this->photoProvider = $photoProvider;
        $this->stringDecoder = $stringDecoder;
    }

    /**
     * @param string $website
     * @return bool
     */
    public function isValid(string $website): bool
    {
        if (strpos(strtolower($website), '.aspx') !== false) {
            return true;
        }

        return false;
    }

    /**
     * @param string $website
     * @return array
     * @throws DownloadElementPhotosException
     */
    public function getPhotos(string $website): array
    {
        try {
            $dom = new Dom;
            $dom->setOptions([
                'removeScripts' => false
            ]);
            $dom->loadFromUrl($website);
            $photos = $dom->find("script",0)->innerhtml;
        } catch(Throwable $e) {
            printf("Could not download Photos Elements: %s", $e->getMessage());
            throw new DownloadElementPhotosException();
        }
        $photos = $this->photoCollector->collect($photos);
        $this->stringDecoder->decode($photos);
        $photos = $this->photoProvider->provide($photos, $website);

        return $photos;
    }
}