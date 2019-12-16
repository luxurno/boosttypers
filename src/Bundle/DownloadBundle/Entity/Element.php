<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Entity;

use App\Bundle\DownloadBundle\Entity\ElementPhoto;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="download_element")
 */
class Element
{
    /**
     * @var int
     * 
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", unique=true)
     */
    protected $link;
    
    /**
     * @var bool
     * 
     * @ORM\Column(name="is_video", type="boolean", options={"default":0})
     */
    protected $isVideo = 0;
    
    /**
     * @var int
     * 
     * @ORM\Column(name="photo_number", type="integer", nullable=true)
     */
    protected $photoNumber;

    /**
     * @ORM\OneToMany(targetEntity="ElementPhoto", mappedBy="sample", cascade={"persist"})
     */  
    protected $photos;
    /**
     * @var DateTime $created
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;
    
    /**
     * @var DateTime $updated
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    protected $updatedAt;
    
    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function prePersist()
    {
        $dateTimeNow = new DateTime('now');
        $this->setUpdatedAt($dateTimeNow);
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt($dateTimeNow);
        }
    }
    
    public function __construct()
    {
        $this->photos = new ArrayCollection();
    }
    
    public function addPhoto(ElementPhoto $elementPhoto)
    {
       $this->photos->add($elementPhoto); 
       $elementPhoto->setElement($this);
       
       return $this;
    }
    
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
    
    public function setIsVideo(bool $isVideo): void
    {
        $this->isVideo = $isVideo;
    }
    
    public function getIsVideo(): bool
    {
        return $this->isVideo;
    }
    
    public function setPhotoNumber(int $photoNumber): void
    {
        $this->photoNumber = $photoNumber;
    }
    
    public function getPhotoNumber(): int
    {
        $this->photoNumber;
    }

    public function getCreatedAt() :?DateTime
    {
        return $this->createdAt;
    }
    
    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    public function getUpdatedAt() :?DateTime
    {
        return $this->updatedAt;
    }
    
    public function setUpdatedAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
