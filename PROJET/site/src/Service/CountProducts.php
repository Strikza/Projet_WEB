<?php
namespace App\Service;

class CountProducts
{
    // Compte le nombre d'objet de la table produit
    public function countProducts($products): int{
        $n = 0;
        foreach ($products as $product){
            $n++;
        }
        return $n;
    }

}

/*  Authors :
 *      - ANDRIANARIVONY Henintsoa
 *      - GOUBEAU Samuel
 */ 
