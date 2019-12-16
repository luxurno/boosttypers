<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Factory;

use App\Bundle\DownloadBundle\DTO\ElementPhotoDTO;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
interface ElementPhotoDTOFactoryInterface
{
    public function factory(): ElementPhotoDTO;
}
