<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Users;

class UtilityController extends AbstractController
{
    protected function getEntityManager() : EntityManagerInterface {
        return $this->getDoctrine()->getManager();
    }


    // Retourne tous les utilisateurs
    /**
     * @return array<int, object>
     */
    protected function getUsers() {
        return $this->getEntityManager()->getRepository('App:Users')->findAll();
    }


    // Retourne tous les produits
    /**
     * @return array<int, object>
     */
    protected function getProducts() {
        return $this->getEntityManager()->getRepository('App:Products')->findAll();
    }


    // Compte le nombre d'objet de la table produit
    protected function countProducts(): int{
        $products = $this->getProducts();
        $n = 0;

        foreach ($products as $product){
            $n++;
        }

        return $n;
    }

    // Retourne tous les paniers
    /**
     * @return array<int, object>
     */
    protected function getCarts() {
        return $this->getEntityManager()->getRepository('App:Carts')->findAll();
    }


    // Récupère l'utilisateur (utilisateur existant ou null)
    protected function getUser() : ?Users {
        $id = $this->getParameter('id');
        return $this->getEntityManager()->getRepository('App:Users')->find($id);
    }


    // Permet de restreindre l'accès à une page, selon le type entré en paramètre
    public function setRestriction($type){
        $user = $this->getUser();
        switch ($type){
            case 1 :
                //Vérifie que l'utilisateur est un administrateur
                if(is_null($user) || !($user->getIsAdmin())) {
                    throw $this->createNotFoundException('Vous devez être connecté(e) en tant qu\'administrateur pour avoir accès à cette page !');
                }
                break;
            case 2 :
                //Vérifie que l'utilisateur est un client
                if(is_null($user) || $user->getIsAdmin()) {
                    throw $this->createNotFoundException('Vous devez être connecté(e) en tant que client pour avoir accès à cette page !');
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
