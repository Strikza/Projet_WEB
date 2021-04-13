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

class AccountController extends AbstractController
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
        if(!is_null($user)) {
            throw $this->createNotFoundException('Vous êtes connecté(e) à un compte, veuillez vous déconnecter !');
        }

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
        if(is_null($user) || $user->getIsAdmin()) {
            throw $this->createNotFoundException('Vous devez être connecté(e) comme client pour avoir accès à cette page !');
        }

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
        if(is_null($user) || !($user->getIsAdmin())) {
            throw $this->createNotFoundException('Vous devez être connecté(e) comme administrateur pour avoir accès à cette page !');
        }

        $args = ['user' => $user];
        return $this->render('account/manage_account.html.twig',$args);
    }
}
