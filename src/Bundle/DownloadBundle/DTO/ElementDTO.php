<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\DTO;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ElementDTO
{
    /** @var string */
    private $link;
    
    /** @var string */
    private $url;
    
    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }
    
    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }
    
    /**
     * @param string $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }
    
    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}
