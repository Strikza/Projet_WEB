<?php

namespace App\Controller;

use App\Entity\Products;
use App\Form\ProductType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProductController
 * @package App\Controller
 * @Route ("/product")
 */
class ProductController extends UtilityController
{
    /**
     * @Route("/", name="product_list")
     */
    public function listAction(): Response
    {
        //Vérifie que l'utilisateur est un client (type = 2)
        $this->setRestriction( 2);

        //Recupère les produits
        $args = array('products' => $this->getProducts());
        return $this->render('product/list_product.html.twig',$args);
    }

    /**
     * @Route("/add", name="product_add")
     */
    public function addAction(Request $request): Response
    {
        //Vérifie que l'utilisateur est un administrateur (type = 1)
        $this->setRestriction(1);

        $product = new Products();
        $form = $this->createForm(ProductType::class, $product);
        $form->add('submit',SubmitType::class,['label' => 'Créer']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getEntityManager();
            $em->persist($product);
            $em->flush();

            $this->addFlash('info', 'Le produit a bien été créé et ajouter à la base !');
            return $this->redirectToRoute('home_home');
        } else {

            $this->addFlash('info', 'Le formulaire n\' pas été correctement rempli !');
            return $this->render('product/add_product.html.twig', ["form_add_product" => $form->createView()]);
        }
    }

}
