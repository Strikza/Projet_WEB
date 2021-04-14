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
        $id = $this->getParameter('id');

        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('App:Users');
        $user = $userRepository->find($id);

        //Vérifie si l'utilisateur est un client
        $this->isConnect($user, 2, $this);

        $productRepository = $em->getRepository('App:Products');
        $products = $productRepository->findAll();
        $args = array('products' => $products);

        return $this->render('product/list_product.html.twig',$args);
    }

    /**
     * @Route("/add", name="product_add")
     */
    public function addAction(): Response
    {
        $id = $this->getParameter('id');

        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('App:Users');
        $user = $userRepository->find($id);

        //Vérifie si l'utilisateur est un administrateur
        $this->isConnect($user, 1, $this);

        return $this->render('product/add_product.html.twig');
    }
}
