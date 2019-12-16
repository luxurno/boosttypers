<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Entity;

use App\Bundle\DownloadBundle\Entity\Element;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="download_element_photo")
 */
class ElementPhoto
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
    protected $href;
    
    /**
     * @ORM\ManyToOne(targetEntity="Element", inversedBy="analyses", cascade={"persist"})
     * @ORM\JoinColumn(name="element_id", referencedColumnName="id")
     */
     protected $element;

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
    
    public function setElement(Element $element): void
    {
        $this->element = $element;
    }
    
    public function getId(): int
    {
        return $this->id;
    }

    public function setHref(string $href): void
    {
        $this->href = $href;
    }
    
    public function getHref(): string
    {
        return $this->href;
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
