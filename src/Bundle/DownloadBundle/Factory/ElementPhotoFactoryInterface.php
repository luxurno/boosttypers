<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Factory;

use App\Bundle\DownloadBundle\Entity\ElementPhoto;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
interface ElementPhotoFactoryInterface
{
    public function factory(): ElementPhoto;
}