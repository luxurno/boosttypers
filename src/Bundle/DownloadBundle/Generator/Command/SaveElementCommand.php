<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Generator\Command;

use App\Bundle\DownloadBundle\DTO\ElementDTO;
use SimpleBus\Message\Name\NamedMessage;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class SaveElementCommand implements NamedMessage
{
    /** @var ElementDTO */
    protected $elementDTO;

    public function __construct(ElementDTO $elementDTO)
    {
        $this->elementDTO = $elementDTO;
    }

    /**
     * @return ElementDTO
     */
    public function getElementDTO(): ElementDTO
    {
        return $this->elementDTO;
    }

    /**
     * @return string
     */
    public static function messageName(): string
    {
        return 'App\Bundle\DownloadBundle\Generator\Command\SaveElementCommand';
    }
}
