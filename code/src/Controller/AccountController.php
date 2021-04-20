<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
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
    public function createAction(Request $request): Response
    {
        //Vérifie que l'utilisateur n'est pas authentifié
        $this->setRestriction( 0);

        $user = new Users();

        $form = $this->createForm(UserType::class, $user);
        $form->add('submit',SubmitType::class,['label' => 'Créer']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();

            $em->persist($user);
            $em->flush();

            $this->addFlash('info', 'Le compte a bien été créé');
        }

        return $this->render('account/create_account.html.twig', ["form_create_account" => $form->createView()]);
    }

    /**
     * @Route("/edit", name="account_edit")
     */
    public function editAction(): Response
    {
        //Vérifie que l'utilisateur est un client (type = 2)
        $this->setRestriction(2);

        $form = $this->createForm(UserType::class, $this->getUser());

        $args = ['form_edit_account' => $form];
        return $this->render('account/edit_account.html.twig',$args);
    }

    /**
     * @Route("/manage", name="account_manage")
     */
    public function manageAction(): Response
    {
        //Vérifie que l'utilisateur est un administrateur (type = 1)
        $this->setRestriction(1);

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
        //Vérifie que l'utilisateur est un administrateur (type = 1)
        $this->setRestriction(1);

        $user = $this->getUserById($iduser);
        $em = $this->getEntityManager();

        //TODO : Faire la vidange du panier de l'utilisateur courant

        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute("account_manage");
    }
}
