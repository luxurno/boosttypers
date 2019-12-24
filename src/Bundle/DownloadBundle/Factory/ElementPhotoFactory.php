<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Factory;

use App\Bundle\DownloadBundle\Entity\ElementPhoto;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ElementPhotoFactory implements ElementPhotoFactoryInterface
{
    /**
     * @return ElementPhoto
     */
    public function factory(): ElementPhoto
    {
        return new ElementPhoto();
    }
}