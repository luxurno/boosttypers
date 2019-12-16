<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Converter;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class WebsiteConverter
{
    /**
     * @param string $website
     * @param string $link
     * 
     * @return string
     */
    public function convert(string $website, ?string $link): string
    {
        if (strpos($website, 'http://www.watchthedeer.com/') === 0) {
            $website = explode('/', $website);
            array_pop($website);
            $website = implode('/', $website);
        }
        
        if (null !== $link) {
            $website .= ltrim($link, '.');
        }
        
        return $website;
    }
}