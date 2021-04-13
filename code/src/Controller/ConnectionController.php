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
     * @Route("/co", name="connection_connection")
     */
    public function connectionAction(): Response
    {
        $id = $this->getParameter('id');

        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('App:Users');
        $user = $userRepository->find($id);

        //Vérifie que l'utilisateur n'est pas authentifié
        if(!is_null($user)) {
            throw $this->createNotFoundException('Vous êtes déjà connecté(e) ;)');
        }

        $args = ['user' => $user];
        return $this->render('account/connection_account.html.twig',$args);
    }

    /**
     * @Route("/disco", name="connection_disconnection")
     */
    public function disconnectionAction(): Response
    {
        $this->addFlash('info','Vous avez bien été déconnecté(e) !');

        return $this->redirectToRoute('home_home');
    }
}
