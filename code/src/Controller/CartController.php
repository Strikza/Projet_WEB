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
        /* Configure l'attribut 'user' en fonction de l'utilisateur actuellement connecté */
        $this->setUser();

        //Vérifie si l'utilisateur est un client
        $this->isConnect($this->user, 2, $this);

        return $this->render('cart/display_cart.html.twig');
    }
    /**
     * @Route("/add", name="cart_add")
     */
    public function addAction(): Response
    {
        /* Configure l'attribut 'user' en fonction de l'utilisateur actuellement connecté */
        $this->setUser();

        //Vérifie si l'utilisateur est un client
        $this->isConnect($this->user, 2, $this);

        return $this->render('user/cart.html.twig');
    }


}
