<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilityController extends AbstractController
{

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
                    throw $controller->createNotFoundException('Vous devez être connecté(e) comme administrateur pour avoir accès à cette page !');
                }
                break;
            //Vérifie si l'utilisateur est un client
            default :
                if(is_null($user) || $user->getIsAdmin()) {
                    throw $controller->createNotFoundException('Vous devez être connecté(e) comme client pour avoir accès à cette page !');
                }
        }
    }
}
