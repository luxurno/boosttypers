<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Bundle\DownloadBundle\Repository\ElementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class GalleryController extends AbstractController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function listGallery(Request $request): Response
    {
        
        return $this->render('galery/index.html.twig', [
            'sort_type' => $request->get('sort_type'),
            'sort_by' => $request->get('sort_by'),
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
            'is_video' => $elementEntity->getIsVideo(),
            'photo_number' => $elementEntity->getPhotoNumber(),
            'date' => 'Sep 2015'
        ]);
    }
}
