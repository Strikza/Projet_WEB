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
                'id' => $productRef->getId(),
                'name' => $productRef->getName(),
                'unit_price' => $productRef->getPrice(),
                'total_quantity' => $productOfCard->getQuantity(),
                'total_price' => $price
            ];
            $products[] = $product;
        }

        $args = [
            'products' => $products,
            'totalQuantity' => $totalQuantity,
            'totalPrice' => $totalPrice
        ];
        return $this->render('cart/display_cart.html.twig', $args);
    }

    /**
     * @Route("/res", name="cart_restore")
     */
    private function restoreAction($cartId): void
    {
        //Récupère le produit du panier correspondant
        $productInCart = $this->getCartsRepository()->findOneBy(['id_product' => $cartId]);

        //Change la quantité de stock disponible
        $productToChange = $this->getProductsRepository()->find($productInCart->getIdProduct()->getId());
        $productToChange->setStock(($productToChange->getStock())-($productInCart->getQuantity()));

        //Supprime le produit du panier
        $this->getEntityManager()->remove($cartId);
    }

    /**
     * @Route("/rem", name="cart_remove")
     */
    public function removeAction($cartId): Response
    {
        //Vérifie que l'utilisateur est un client (type = 2)
        $this->setRestriction(2);

        //Remet le produit en stock et le supprime du panier
        $this->restoreAction($cartId);

        //Confirme les changements à la base
        $this->getEntityManager()->flush();

        return $this->redirectToRoute('cart_display');
    }

    /**
     * @Route("/dis", name="cart_discard")
     */
    public function discardAction(): Response
    {
        //Vérifie que l'utilisateur est un client (type = 2)
        $this->setRestriction(2);

        //Récupère le panier de l'utilisateur courant
        $userCart = $this->getCartsRepository()->findBy(['id_user'=> $this->getUser()]);

        //Remet chaque produit en stock et le supprime du panier
        foreach ($userCart as $productOfCart) {
            $this->restoreAction($productOfCart->getId());
        }

        //Confirme les changements à la base
        $this->getEntityManager()->flush();

        return $this->redirectToRoute('cart_display');
    }

    /**
     * @Route("/ord", name="cart_order")
     */
    public function orderAction(): Response
    {
        //Vérifie que l'utilisateur est un client (type = 2)
        $this->setRestriction(2);

        //Récupère le panier de l'utilisateur courant
        $userCart = $this->getCartsRepository()->findBy(['id_user'=> $this->getUser()]);

        //Supprime chaque produit du panier
        foreach ($userCart as $productOfCart) {
            $this->getEntityManager()->remove($productOfCart->getId());
        }

        //Confirme les changements à la base
        $this->getEntityManager()->flush();

        return $this->redirectToRoute('cart_display');
    }


}
