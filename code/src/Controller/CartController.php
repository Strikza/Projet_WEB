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
        //Vérifie que l'utilisateur est un client (type = 1)
        $this->setRestriction(1);

        return $this->render('cart/display_cart.html.twig');
    }
    /**
     * @Route("/add", name="cart_add")
     */
    public function addAction(): Response
    {
        //Vérifie que l'utilisateur est un client (type = 1)
        $this->setRestriction(1);

        return $this->render('user/cart.html.twig');
    }


}
