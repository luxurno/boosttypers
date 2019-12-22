<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Collector;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class PhotoCollector
{
    /**
     * @param string $stringPhotos
     * @return array
     */
    public function collect(string $stringPhotos): array
    {
        if (strpos($stringPhotos, ';') !== false) {
            $photos = explode(';', $stringPhotos);
        } else {
            $photos[] = $stringPhotos;
        }
        
        return $photos;
    }
}
