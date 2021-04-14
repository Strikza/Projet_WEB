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

class ConnectionController extends UtilityController
{
    /**
     * @Route("/co", name="connection_connection")
     */
    public function connectionAction(): Response
    {
        //Vérifie que l'utilisateur n'est pas authentifié
        $this->setRestriction(0);

        $args = ['user' => $this->getUser()];
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
