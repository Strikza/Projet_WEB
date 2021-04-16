<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Users;

class UtilityController extends AbstractController
{
    // Retourne le gestionnaire d'entitée
    protected function getEntityManager() : EntityManagerInterface {
        return $this->getDoctrine()->getManager();
    }

    // Retourne le reperoire d'utilisateurs
    protected function getUsersRepository() : ObjectRepository {
        return $this->getEntityManager()->getRepository('App:Users');
    }

    // Retourne le reperoire de produits
    protected function getProductsRepository() : ObjectRepository {
        return $this->getEntityManager()->getRepository('App:Products');
    }

    // Retourne le reperoire de paniers
    protected function getCartsRepository() : ObjectRepository {
        return $this->getEntityManager()->getRepository('App:Carts');
    }

    // Récupère l'utilisateur via son identifiant (utilisateur existant ou null)
    protected function getUserById($id): ?Users {
        return $this->getUsersRepository()->find($id);
    }

    // Récupère l'utilisateur (utilisateur existant ou null)
    protected function getUser() : ?Users {
        $id = $this->getParameter('id');
        return $this->getUsersRepository()->find($id);
    }


    // Compte le nombre d'objet de la table produit
    protected function countProducts(): int{
        $products = $this->getProductsRepository()->findAll();
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

    // Permet de restreindre l'accès à une page, selon le type entré en paramètre
    // Ajoutez un autre cas si vous voulez ajouter une nouvelle restriction
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
