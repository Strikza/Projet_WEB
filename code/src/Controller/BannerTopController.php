<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BannerTopController
 * @package App\Controller
 */
class BannerTopController extends AbstractController
{
    /**
     * @return Response
     */
    public function bannerTopAction(): Response
    {
        $id = $this->getParameter('id');

        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('App:Users');
        $user = $userRepository->find($id);

        $args = ['user' => $user];

        return $this->render('/main/banner_top.html.twig', $args);
    }
}
