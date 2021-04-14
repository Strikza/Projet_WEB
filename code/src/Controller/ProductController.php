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
class ProductController extends AbstractController
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
        if(is_null($user) || $user->getIsAdmin()) {
            throw $this->createNotFoundException('Vous devez être connecté(e) comme client pour avoir accès à cette page !');
        }

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
        if(is_null($user) || !($user->getIsAdmin())) {
            throw $this->createNotFoundException('Vous devez être connecté(e) comme administrateur pour avoir accès à cette page !');
        }

        return $this->render('product/add_product.html.twig');
    }
}
