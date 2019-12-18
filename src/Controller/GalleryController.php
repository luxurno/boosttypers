<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Service\GaleryService;
use App\Bundle\DownloadBundle\Repository\ElementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class GalleryController extends AbstractController
{
    /**
     * @param GaleryService $galleryService
     * @return Response
     */
    public function listGallery(GaleryService $galleryService): Response
    {
        $results = $galleryService->getResults();
        
        return $this->render('galery/index.html.twig', [
            'category' => '...',
            'promotions' => ['...', '...'],
        ]);
    }

    /**
     * @param ElementRepository $elementRepository
     * @param int $id
     * @return Response
     */
    public function listBrowseGallery(
        ElementRepository $elementRepository,
        int $id
    ): Response
    {
        $elementEntity = $elementRepository->findOneBy(['id' => $id]);
        
        if (!$elementEntity) {
            throw $this->createNotFoundException('The element does not exist');
        }
        return $this->render('galery/browse.html.twig', [
            'id' => $id,
            'isVideo' => $elementEntity->getIsVideo(),
            'photoNumber' => $elementEntity->getPhotoNumber(),
            'date' => 'Sep 2015'
        ]);
    }
}
