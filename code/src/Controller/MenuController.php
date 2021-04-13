<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MenuController
 * @package App\Controller
 */

class MenuController extends AbstractController
{
    /**
     * @return Response
     */
    public function menuAction(): Response
    {
        $id = $this->getParameter('id');

        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('App:Users');
        $user = $userRepository->find($id);

        $args = ['user' => $user];

        return $this->render('main/menu.html.twig',$args);

    }
}
