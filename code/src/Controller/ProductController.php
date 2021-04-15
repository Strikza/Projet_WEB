<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProductController
 * @package App\Controller
 * @Route ("/product")
 */
class ProductController extends UtilityController
{
    /**
     * @Route("/", name="product_list")
     */
    public function listAction(): Response
    {
        //Vérifie si l'utilisateur est un client (type = 1)
        $this->setRestriction( 1);

        //Recupère les produits
        $args = array('products' => $this->getProducts());
        return $this->render('product/list_product.html.twig',$args);
    }

    /**
     * @Route("/add", name="product_add")
     */
    public function addAction(): Response
    {
        //Vérifie si l'utilisateur est un administrateur (type = 2)
        $this->setRestriction(2);

        return $this->render('product/add_product.html.twig');
    }

}
