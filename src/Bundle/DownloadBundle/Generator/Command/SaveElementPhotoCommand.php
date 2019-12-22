<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Generator\Command;

use App\Bundle\DownloadBundle\DTO\ElementDTO;
use App\Bundle\DownloadBundle\DTO\ElementPhotoDTO;
use SimpleBus\Message\Name\NamedMessage;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class SaveElementPhotoCommand implements NamedMessage
{
    /** @var ElementDTO */
    protected $elementDTO;

    /** @var ElementPhotoDTO */
    protected $elementPhotoDTO;

    public function __construct(
        ElementDTO $elementDTO,
        ElementPhotoDTO $elementPhotoDTO
    )
    {
        $this->elementDTO = $elementDTO;
        $this->elementPhotoDTO = $elementPhotoDTO;
    }

    /**
     * @return ElementDTO
     */
    public function getElementDTO(): ElementDTO
    {
        return $this->elementDTO;
    }

    /**
     * @return ElementPhotoDTO
     */
    public function getElementPhotoDTO(): ElementPhotoDTO
    {
        return $this->elementPhotoDTO;
    }

    /**
     * @return string
     */
    public static function messageName(): string
    {
        return 'App\Bundle\DownloadBundle\Generator\Command\SaveElementPhotoCommand';
    }
}
