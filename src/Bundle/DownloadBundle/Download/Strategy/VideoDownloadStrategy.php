<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Download\Strategy;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class VideoDownloadStrategy extends AbstractStrategy
{
    /**
     * @param string $website
     * @return bool
     */
    public function isValid(string $website): bool
    {
        if (strpos(strtolower($website), '.mov') !== false) {
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
        return [$website];
    }
}