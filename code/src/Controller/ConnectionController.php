<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ConnectionController
 * @package App\Controller
 * @Route("/connection")
 */

class ConnectionController extends AbstractController
{
    /**
     * @Route("/co", name="connection")
     */
    public function connectionAction(): Response
    {
        $id = $this->getParameter('id');

        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('App:Users');
        $user = $userRepository->find($id);

        $args = ['user' => $user];

        return $this->render('guest/connection.html.twig',$args);
    }

    public function disconnectionAction(): Response
    {
        $this->addFlash('info','Vous avez bien été déconnecté(e) !');

        return $this->redirectToRoute('home');
    }
}
