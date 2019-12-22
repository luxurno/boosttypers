<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Validator;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ElementPhotoValidator
{
    /**
     * @param string $website
     * @return bool
     */
    public function validate(string $website): bool
    {
        if (strpos(strtolower($website), '.aspx') !== false) {
            return true;
        }

        return false;
    }
}
