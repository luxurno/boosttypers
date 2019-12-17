<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Controller;

use App\Bundle\DownloadBundle\Service\DownloadService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;

ini_set('max_execution_time', '300');

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class DownloadController extends AbstractController
{
    /**
     * @param DownloadService $downloadService
     * @param string $address
     * @param int $count
     */
    public function download(
        DownloadService $downloadService,
        SessionInterface $session,
        string $address,
        int $count
    ): Response
    {
        $downloadService->download($address, $count);
        $session->set('isDownloaded', true);
        
        $response = $this->forward('App\Controller\GaleryController::viewGalery', [
            'count'  => $count,
        ]);
        
        return $response;
    }
}
