<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Finder\ElementFinder;
use App\Finder\ElementPhotoFinder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ElementController extends AbstractController
{
    /**
     * @param int $count
     * @return JsonResponse
     */
    public function getElements(
        ElementFinder $elementFinder,
        Request $request
    ): JsonResponse
    {
        $sortBy = $request->get('sort_by');
        if (false === empty($sortBy)) {
            $sortBy = strtoupper($sortBy);
        }

        $elements = $elementFinder->findByCriteria(
            [],
            (int) $request->get('limit'),
            $request->get('sort_type'),
            $sortBy
        );

        return new JsonResponse($elements);
    }

    /**
     * @param ElementPhotoFinder $elementPhotoFinder
     * @param int $id
     * @return JsonResponse
     */
    public function getElementPhotos(
        ElementPhotoFinder $elementPhotoFinder,
        int $id
    ): JsonResponse
    {
        $elements = $elementPhotoFinder->findByCriteria(
            ['element_id' => $id]
        );
        
        return new JsonResponse($elements);
    }
}
