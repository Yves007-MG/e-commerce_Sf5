<?php

namespace App\Controller;

use App\Classe\Cart;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    
    /**
     * @Route("/mon-panier", name="cart")
     */
    public function index(): Response
    {
        // $carts = $this-cart
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }
    /**
     * @Route("/cart/add/{id}", name="add_to_cart")
     */
    public function ajout(Cart $cart,$id)
    {
        $cart->add($id);

        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }
}
