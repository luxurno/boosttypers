<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Generator;

use App\Bundle\DownloadBundle\DTO\ElementDTO;
use App\Bundle\DownloadBundle\Generator\Command\SaveElementCommand;
use SimpleBus\SymfonyBridge\Bus\CommandBus;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ElementGenerator
{
    /** @var CommandBus */
    private $commandBus;

    /**
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }
    
    /**
     * @param ElementDTO $elementDTO
     */
    public function generate(ElementDTO $elementDTO): void
    {
        $this->commandBus->handle(new SaveElementCommand($elementDTO));
    }
}
