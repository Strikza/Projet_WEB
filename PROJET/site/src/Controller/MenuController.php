<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CountProducts;

/**
 * Class MenuController
 * @package App\Controller
 */

class MenuController extends UtilityController
{
    /**
     * @return Response
     */
    public function menuAction(): Response
    {
        //$utl = $this->get('app.utility'); // Ne fonctionne pas, et affiche une erreur
        $utl = new CountProducts();

        $args = ['user' => $this->getUser(),
                 'nbProducts' => $utl->countProducts($this->getProductsRepository()->findAll())];

        return $this->render('main/menu.html.twig',$args);
    }
}

/*  Authors :
 *      - ANDRIANARIVONY Henintsoa
 *      - GOUBEAU Samuel
 */ 
