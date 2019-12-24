<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Factory;

use App\Bundle\DownloadBundle\Entity\Element;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ElementFactory implements ElementFactoryInterface
{
    /**
     * @return Element
     */
    public function factory(): Element
    {
        return new Element();
    }
}