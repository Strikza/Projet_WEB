<?php

namespace App\Controller;

use App\Entity\Carts;
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
    public function listAction(Request $request): Response
    {
        //Vérifie que l'utilisateur est un client (type = 2)
        $this->setRestriction( 2);

        //Met à jour le panier si un formulaire a été envoyé
        $products_post = $request->request->all();
        if (!empty($products_post)) {
            foreach ($products_post as $productId => $productQuantity) {
                $product = $this->getProductsRepository()->find($productId);
                $stock = $product->getStock();

                if (0<$productQuantity || $productQuantity<$stock) {

                    $user = $this->getUser();
                    $productInCart = $this->getCartsRepository()->findOneBy(['user' => $user, 'product' => $product]);

                    if (is_null($productInCart)) {
                        $cart = new Carts();
                        $cart->setIdUser($user)
                            ->setIdProduct($product)
                            ->setQuantity($productQuantity);

                        $this->getEntityManager()->persist($cart);
                    } else {
                        $productInCart->setQuantity($productInCart->getQuantity()+$productQuantity);
                    }
                    $this->getEntityManager()->flush();

                } elseif ($productQuantity != 0) {
                    throw $this->createNotFoundException('ERROR FORMULAIRE : quantité de produits invalide');
                }
            }
        }

        //Recupère les produits et les passe à la vue
        $args = array('products' => $this->getProductsRepository()->findAll());
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
