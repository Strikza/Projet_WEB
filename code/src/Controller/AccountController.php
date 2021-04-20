<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UserType;
use App\Controller\CartController;
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
    public function editAction(Request $request): Response
    {
        //Vérifie que l'utilisateur est un client (type = 2)
        $this->setRestriction(2);
        $cur_user = $this->getUser();

        $form = $this->createForm(UserType::class, $cur_user);
        $form->add('submit',SubmitType::class,['label' => 'Créer']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();

            $em->persist($cur_user);
            $em->flush();

            $this->addFlash('info', 'Le compte a bien été modifié');
            return $this->redirectToRoute("product_list");
        }

        $args = ['form_edit_account' => $form->createView()];
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

        //Récupère le panier de l'utilisateur courant
        $userCart = $this->getCartsRepository()->findBy(['id_user'=> $this->getUser()]);

        //Remet chaque produit en stock et le supprime du panier
        foreach ($userCart as $productOfCart) {
            $this->restoreAction($productOfCart->getId());
        }

        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute("account_manage");
    }
}
