<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Validator;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class PhotoElementLinkValidator
{
    /**
     * @param string $url
     * @return bool
     */
    public function validate(string $url): bool
    {
        $url = strtolower($url);
        
        if (strpos($url, '.mov') !== false) {
            return false;
        }
        
        return true;
    }
}
