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
        $id = $this->getParameter('id');

        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('App:Users');
        $user = $userRepository->find($id);

        //Vérifie que l'utilisateur n'est pas authentifié
        $this->isConnect($user, 0, $this);

        $args = ['user' => $user];
        return $this->render('account/create_account.html.twig',$args);
    }

    /**
     * @Route("/edit", name="account_edit")
     */
    public function editAction(): Response
    {
        $id = $this->getParameter('id');

        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('App:Users');
        $user = $userRepository->find($id);

        //Vérifie si l'utilisateur est un client
        $this->isConnect($user, 2, $this);

        $args = ['user' => $user];
        return $this->render('account/edit_account.html.twig',$args);
    }

    /**
     * @Route("/manage", name="account_manage")
     */
    public function manageAction(): Response
    {
        $id = $this->getParameter('id');

        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('App:Users');
        $user = $userRepository->find($id);

        //Vérifie si l'utilisateur est un administrateur
        $this->isConnect($user, 1, $this);

        $args = ['user' => $user];
        return $this->render('account/manage_account.html.twig',$args);
    }
}
