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
     * @Route("/", name="product_display")
     */
    public function displayAction(): Response
    {
        $id = $this->getParameter('id');

        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('App::Users');
        $user = $userRepository->find($id);
    }

    #DESCRIPTION : Action only available for admin
    /**
     * @Route("/add", name="product_add")
     */
    public function addAction(): Response
    {
        $id = $this->getParameter('id');

        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('App::Users');
        $user = $userRepository->find($id);

        #TO DO : Manage accessibility
        return $this->render();
    }
}
