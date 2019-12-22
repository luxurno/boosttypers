<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Converter;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class VideoConverter
{
    /**
     * @param string $website
     * @param string $href
     * @return string
     */
    public function convert(string $website, string $href): string
    {
        if (strpos($website, 'Viewer') !== false) {
            $website = explode('/', $website);
            array_pop($website);
            $website = implode('/', $website);
        }

        return $website."/".$href;
    }
}
