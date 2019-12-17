<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Validator;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class PhotoProviderValidator
{
    /**
     * @param string $href
     * @return bool
     */
    public function validate(string $href): bool
    {
        if (strpos(strtolower($href), '.jpg') !== false) {
            return true;
        }
        
        return false;
    }
    
}
