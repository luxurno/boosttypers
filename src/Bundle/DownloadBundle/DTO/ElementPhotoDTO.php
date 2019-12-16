<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\DTO;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ElementPhotoDTO
{
    /** @var string */
    private $href;
    
    /**
     * @param string $href
     */
    public function setHref(string $href): void
    {
        $this->href = $href;
    }
    
    /**
     * @return string
     */
    public function getHref(): string
    {
        return $this->href;
    }
}
