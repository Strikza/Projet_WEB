<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CartController
 * @package App\Controller
 * @Route("/cart")
 */

class CartController extends UtilityController
{

    /**
     * @Route("/list", name="cart_display")
     */
    public function displayAction(): Response
    {
        $id = $this->getParameter('id');

        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('App:Users');
        $user = $userRepository->find($id);

        //Vérifie si l'utilisateur est un client
        if(is_null($user) || $user->getIsAdmin()) {
            throw $this->createNotFoundException('Vous devez être connecté(e) comme client pour avoir accès à cette page !');
        }

        return $this->render('cart/display_cart.html.twig');
    }
    /**
     * @Route("/add", name="cart_add")
     */
    public function addAction(): Response
    {
        $id = $this->getParameter('id');

        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('App:Users');
        $user = $userRepository->find($id);

        return $this->render('user/cart.html.twig');
    }


}
