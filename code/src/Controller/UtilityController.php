<?php

namespace App\Controller;

use App\Entity\Carts;
use App\Entity\Products;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;

class UtilityController extends AbstractController
{
    /*protected $user;*/
    protected $productRepository;

    private function getEntityManager() : EntityManagerInterface {
        return $this->getDoctrine()->getManager();
    }

    /* Retourne le repertoire d'utilisateurs */
    public function getUserRepository() : EntityRepository {
        return $this->getEntityManager()->getRepository('App:Users');
    }

    /* Retourne le repertoire de produits */
    public function getProductRepository() : EntityRepository {
        $this->productRepository = $this->getEntityManager()->getRepository('App:Products');
        return $this->getEntityManager()->getRepository('App:Products');
    }

    /* Retourne le repertoire de paniers */
    public function getCartRepository() : EntityRepository {
        return $this->getEntityManager()->getRepository('App:Carts');
    }

    /* Récupère l'utilisateur (utilisateur existant ou null) */

    public function getUser() : ?Users {
        $id = $this->getParameter('id');
        $userRepository = $this->getUserRepository();

        return $userRepository->find($id);
    }

    /* Permet de restreindre l'accès à une page,  */
    public function setRestriction($type){
        $user = $this->getUser();
        switch ($type){
            case 1 :
                //Vérifie que l'utilisateur est un client
                if(is_null($user) || $user->getIsAdmin()) {
                    throw $this->createNotFoundException('Vous devez être connecté(e) en tant que client pour avoir accès à cette page !');
                }
                break;
            case 2 :
                //Vérifie que l'utilisateur est un administrateur
                if(is_null($user) || !($user->getIsAdmin())) {
                    throw $this->createNotFoundException('Vous devez être connecté(e) en tant qu\'administrateur pour avoir accès à cette page !');
                }
                break;
            case 3 :
                //Vérifie que est connecté, en tant qu'administrateur ou client
                if(is_null($user)) {
                    throw $this->createNotFoundException('Vous devez être connecté(e) en tant qu\'administrateur ou client pour avoir accès à cette page !');
                }
            default :
                //Vérifie que l'utilisateur n'est pas authentifié
                if(!is_null($user)) {
                    throw $this->createNotFoundException('Vous êtes connecté(e) à un compte, veuillez vous déconnecter !');
                }
        }
    }
}
