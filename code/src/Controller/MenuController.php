<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MenuController
 * @package App\Controller
 */

class MenuController extends UtilityController
{
    /**
     * @return Response
     */
    public function menuAction(): Response
    {
        $args = ['user' => $this->getUser()];

        return $this->render('main/menu.html.twig',$args);
    }
}
