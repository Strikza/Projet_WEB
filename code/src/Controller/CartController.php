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
     * @Route("/", name="cart_display")
     */
    public function displayAction(): Response
    {
        //Vérifie que l'utilisateur est un client (type = 2)
        $this->setRestriction(2);

        //Récupère les lignes de la table qui concerne l'utilisateur courant
        $cart = $this->getCartsRepository()->findBy(['id_user' => $this->getUser()]);

        //Variable pour stocker les éléments à NULL
        $products = [];
        $totalQuantity = 0;
        $totalPrice = 0.0;

        foreach ($cart as $productOfCard) {
            $productRef = $productOfCard->getIdProduct();

            //Calcule le prix total pour le produit courant
            $price = $productRef->getPrice() * $productOfCard->getQuantity();

            $totalPrice += $price;
            $totalQuantity += $productOfCard->getQuantity();

            $product = [
                'name' => $productRef->getName(),
                'unit_price' => $productRef->getPrice(),
                'total_quantity' => $productOfCard->getQuantity(),
                'total_price' => $price];
        }
        $args = [
            'products' => $products,
            'totalQuantity' => $totalQuantity,
            'totalPrice' => $totalPrice
        ];
        return $this->render('cart/display_cart.html.twig', $args);
    }
    /**
     * @Route("/add", name="cart_add")
     */
    public function addAction(): Response
    {
        //Vérifie que l'utilisateur est un client (type = 2)
        $this->setRestriction(2);


        return $this->render('user/cart.html.twig');
    }


}
