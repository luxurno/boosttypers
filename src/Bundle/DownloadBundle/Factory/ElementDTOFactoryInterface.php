<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Factory;

use App\Bundle\DownloadBundle\DTO\ElementDTO;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
interface ElementDTOFactoryInterface
{
    public function factory(): ElementDTO;
}
