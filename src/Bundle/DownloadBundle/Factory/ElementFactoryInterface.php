<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Factory;

use App\Bundle\DownloadBundle\Entity\Element;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
interface ElementFactoryInterface
{
    public function factory(): Element;
}