<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity 
 * @ORM\Table(name="download_element")
 */
class Element
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $title;

    /**
     * @ORM\Column(type="string", unique=true)
     * @var string
     */
    protected $link;
    
    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    
    public function getLink(): string
    {
        return $this->link;
    }
    
    public function setLink(string $link): void
    {
        $this->link = $link;
    }
}
