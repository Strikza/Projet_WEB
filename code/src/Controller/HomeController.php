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
class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function homeAction(): Response
    {
        $id = $this->getParameter('id');

        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('App::Users');
        $user = $userRepository->find($id);

        $args = ['user' => $user];
        return $this->render('home/home.html.twig',$args);
    }
}
