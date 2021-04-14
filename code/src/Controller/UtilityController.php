<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;

class UtilityController extends AbstractController
{
<<<<<<< HEAD
    protected $user;

    public function setUser(){
        $id = $this->getParameter('id');

        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('App:Users');
        $this->user = $userRepository->find($id);
    }
=======
>>>>>>> main

    public function isConnect($user, $type, $controller){
        switch ($type){
            case 0 :
                //Vérifie que l'utilisateur n'est pas authentifié
                if(!is_null($user)) {
                    throw $controller->createNotFoundException('Vous êtes connecté(e) à un compte, veuillez vous déconnecter !');
                }
                break;
            //Vérifie si l'utilisateur est un administrateur
            case 1 :
                if(is_null($user) || !($user->getIsAdmin())) {
                    throw $controller->createNotFoundException('Vous devez être connecté(e) en tant qu\'administrateur pour avoir accès à cette page !');
                }
                break;
            //Vérifie si l'utilisateur est un client
            default :
                if(is_null($user) || $user->getIsAdmin()) {
                    throw $controller->createNotFoundException('Vous devez être connecté(e) en tant que client pour avoir accès à cette page !');
                }
        }
    }
}
