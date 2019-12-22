<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\DTO;

use DateTime;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ElementDTO
{
    /** @var int */
    private $id;

    /** @var string */
    private $link;
    
    /** @var string */
    private $title;

    /** @var DateTime|null */
    private $date;
    
    /** @var bool */
    private $isVideo;
    
    /** @var int */
    private $photoNumber;

    /**
     * @param string $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

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
    public function setTitle(string $title): void
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

    /**
     * @param DateTime|null $date
     */
    public function setDate(?DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return DateTime|null
     */
    public function getDate(): ?DateTime
    {
        return $this->date;
    }
    
    /**
     * @param bool $isVideo
     */
    public function setIsVideo(bool $isVideo): void
    {
        $this->isVideo = $isVideo;
    }
    
    /**
     * @return bool
     */
    public function getIsVideo(): bool
    {
        return $this->isVideo;
    }
    
    /**
     * @param int $photoNumber
     */
    public function setPhotoNumber(int $photoNumber): void
    {
        $this->photoNumber = $photoNumber;
    }
    
    /**
     * @return int
     */
    public function getPhotoNumber(): int
    {
        return $this->photoNumber;
    }
}
