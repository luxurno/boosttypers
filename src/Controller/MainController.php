<?php

declare(strict_types = 1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class MainController extends AbstractController
{
    public function getGalery(
        SessionInterface $session
    ): Response
    {
        if ($session->get('isDownloaded')) {
            $response = $this->forward('App\Controller\GaleryController::viewGalery', [
                'count'  => $this->getParameter('download.count'),
            ]);
        } else {
            $response = $this->forward('App\Bundle\DownloadBundle\Controller\DownloadController::download', [
                'address'  => $this->getParameter('download.address'),
                'count'  => $this->getParameter('download.count'),
            ]);
        }
        
        return $response;
    }
}
