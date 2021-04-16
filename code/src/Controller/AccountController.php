<?php

namespace App\Controller;

use App\Entity\Users;
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
        //Vérifie que l'utilisateur n'est pas authentifié
        $this->setRestriction( 0);

        $args = ['user' => $this->getUser()];
        return $this->render('account/create_account.html.twig',$args);
    }

    /**
     * @Route("/edit", name="account_edit")
     */
    public function editAction(): Response
    {
        //Vérifie que l'utilisateur est un client (type = 1)
        $this->setRestriction(1);

        $args = ['user' => $this->getUser()];
        return $this->render('account/edit_account.html.twig',$args);
    }

    /**
     * @Route("/manage", name="account_manage")
     */
    public function manageAction(): Response
    {
        //Vérifie que l'utilisateur est un administrateur (type = 2)
        $this->setRestriction(2);

        $args = ['users' => $this->getUsers()];
        return $this->render('account/manage_account.html.twig',$args);
    }

    /**
     * @Route(
     *     "/delete/{iduser}",
     *     name="account_delete",
     *     requirements={"iduser": "[0-9]+"}
     *     )
     */
    public function deleteAction($iduser): Response
    {
        //Vérifie que l'utilisateur est un administrateur (type = 2)
        $this->setRestriction(2);

        $user = $this->getUserById($iduser);
        $em = $this->getEntityManager();

        //TODO : Faire la vidange du panier de l'utilisateur courant

        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute("account_manage");
    }

    /**
     * @Route(
     *     "/addTest",
     *     name="account_addTest"
     *     )
     */
    public function addTestAction(): Response
    {
        //Vérifie que l'utilisateur est un administrateur (type = 2)
        $this->setRestriction(2);

        $em = $this->getEntityManager();

        $user = new Users();
        $user->setUsername("test")
            ->setPassword("test")
            ->setIsAdmin(0)
            ->setName("Test")
            ->setFirstname("test");

        dump($user);

        $em->persist($user);
        $em->flush();
        dump($user);

        return $this->redirectToRoute("account_manage");
    }
}
