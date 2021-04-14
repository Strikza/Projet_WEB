<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        //Vérifie si l'utilisateur est un client
        $this->setRestriction( 1);


        //Recupère le repertoire de produits
        $productRepository = $this->getProductRepository();
        $args = array('products' => $productRepository);

        return $this->render('product/list_product.html.twig',$args);
    }

    /**
     * @Route("/add", name="product_add")
     */
    public function addAction(): Response
    {
        //Vérifie si l'utilisateur est un administrateur
        $this->setRestriction(2);

        return $this->render('product/add_product.html.twig');
    }

}
