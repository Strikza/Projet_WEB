<?php

namespace App\Controller;

use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends UtilityController
{
    /**
     * @Route("/", name="home_home")
     */
    public function homeAction(): Response
    {
        $args = ['user' => $this->getUser()];
        return $this->render('common/home.html.twig',$args);
    }
}

/*  Authors :
 *      - ANDRIANARIVONY Henintsoa
 *      - GOUBEAU Samuel
 */ 
