<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Manipulator;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class PhotoManipulator
{
    /**
     * @param string $href
     * @return string
     */
    public function manipulate(string $href): string
    {
        $href = rtrim($href);
        if (strpos($href, "'") !== false) {
            $href = explode("'", $href);
            $href = "$href[1]";
        }
        
        return $href;
    }
}
