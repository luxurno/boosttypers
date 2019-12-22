<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Download\Strategy;

use App\Bundle\DownloadBundle\Collector\PhotoCollector;
use App\Bundle\DownloadBundle\Provider\PhotoProvider;
use App\Bundle\DownloadBundle\Service\JavascriptDownloadService;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class JavascriptDownloadStrategy extends AbstractStrategy
{
    /** @var JavascriptDownloadService */
    private $javascriptDownloadService;

    public function __construct(JavascriptDownloadService $javascriptDownloadService)
    {
        $this->javascriptDownloadService = $javascriptDownloadService;
    }

    /**
     * @param string $website
     * @return bool
     */
    public function isValid(string $website): bool
    {
        if (strpos($website, 'javascript') !== false) {
            return true;
        }

        return false;
    }

    /**
     * @param string $website
     * @return array
     */
    public function getPhotos(string $website): array
    {
        $video = $this->javascriptDownloadService->getVideo($website);

        if ($video !== null) {
            return [$video];
        } else {
            return [];
        }
    }
}