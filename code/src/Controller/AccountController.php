<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AccountController
 * @package App\Controller
 * @Route("/account")
 */

class AccountController extends UtilityController
{


        /**
     * @Route("/create", name="account_create")
     */
    public function createAction(): Response
    {
        /* Configure l'attribut 'user' en fonction de l'utilisateur actuellement connecté */
        $this->setUser();

        //Vérifie que l'utilisateur n'est pas authentifié
        $this->isConnect($this->user, 0, $this);

        $args = ['user' => $this->user];
        return $this->render('account/create_account.html.twig',$args);
    }

    /**
     * @Route("/edit", name="account_edit")
     */
    public function editAction(): Response
    {
        /* Configure l'attribut 'user' en fonction de l'utilisateur actuellement connecté */
        $this->setUser();

        //Vérifie si l'utilisateur est un client
        $this->isConnect($this->user, 2, $this);

        $args = ['user' => $this->user];
        return $this->render('account/edit_account.html.twig',$args);
    }

    /**
     * @Route("/manage", name="account_manage")
     */
    public function manageAction(): Response
    {
        /* Configure l'attribut 'user' en fonction de l'utilisateur actuellement connecté */
        $this->setUser();

        //Vérifie si l'utilisateur est un administrateur
        $this->isConnect($this->user, 1, $this);

        $args = ['user' => $this->user];
        return $this->render('account/manage_account.html.twig',$args);
    }
}
