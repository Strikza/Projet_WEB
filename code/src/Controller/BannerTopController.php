<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BannerTopController
 * @package App\Controller
 */
class BannerTopController extends UtilityController
{
    /**
     * @return Response
     */
    public function bannerTopAction(): Response
    {
        /* Configure l'attribut 'user' en fonction de l'utilisateur actuellement connecté */
        $this->setUser();

        $args = ['user' => $this->user];

        return $this->render('/main/banner_top.html.twig', $args);
    }
}
