<?php

declare(strict_types = 1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class GaleryController extends AbstractController
{
    /**
     * @param int $count
     */
    public function viewGalery(
        int $count
    )
    {
        echo "Tyle: ".$count;
        
        die;
    }
}
