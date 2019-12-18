<?php

declare(strict_types = 1);

namespace App\Service;

use App\Bundle\DownloadBundle\Repository\ElementRepository;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class GaleryService
{
    public function __construct(ElementRepository $elementRepository)
    {
        $this->elementRepository = $elementRepository;
    }
    
    public function getResults()
    {
        return $this->elementRepository->findBy(['title' => 'Fawn Release from Fence- Texas full video']);
    }
}
