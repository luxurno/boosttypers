<?php

declare(strict_types = 1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ElementController extends AbstractController
{
    /**
     * @param int $count
     */
    public function getElements(
        Request $request
    ): JsonResponse
    {
        $paramCount = $request->get('count');
        $paramSort = $request->get('sort');
        
        echo "ParamCount: ".$paramCount."<br/>";
        echo "ParamSort: ".$paramSort."<br/>";
        
        return new JsonResponse();
    }
}
