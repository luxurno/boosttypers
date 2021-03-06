<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Bundle\DownloadBundle\Finder\ElementFinder;
use App\Bundle\DownloadBundle\Repository\ElementRepository;
use App\Bundle\DownloadBundle\Service\DownloadPhotoService;
use App\Bundle\DownloadBundle\Service\DownloadService;
use App\Bundle\DownloadBundle\ValueObject\DownloadValueObject;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class MainController extends AbstractController
{
    /**
     * @param SessionInterface $session
     * @return Response
     */
    public function getUpdate(
        SessionInterface $session
    ): Response
    {
        $response = $this->forward('App\Controller\GalleryController::listGallery', [
            'count'  => $this->getParameter('download.count'),
        ]);

        return $response;
    }
}
