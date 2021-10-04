<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Service\CartSold;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    
    private $session;
    private $productRepository;
    public function __construct(SessionInterface $session,ProductRepository $productRepository)
    {
        $this->session = $session;
        $this->productRepository = $productRepository;
    }
    /**
     * @Route("/mon-panier", name="cart")
     */
    public function index(): Response
    {
      $cartComplet = [];
      foreach ($this->session->get('cart') as $id=>$quantity){
        $cartComplet[] = [
            "product"=>$this->productRepository->findOneById($id),
            "quantity"=>$quantity,
        ];

      }

        return $this->render('cart/index.html.twig', [
            'cart' => $cartComplet,
        ]);
    }
    /**
     * @Route("/cart/add/{id}", name="add_to_cart")
     */
    public function ajout($id)
    { 
        $i =1;
       $cart = $this->session->get('cart', []);
       if(!empty($cart[$id])){
          
        $cart[$id] += $i;
       }else  $cart[$id] = 1;

        $this->session->set('cart',$cart);

        return $this->redirectToRoute('cart');
    }
    /**
     * @Route("/cart/remove", name="remove_cart")
     */
    public function remove()
    {
        $this->session->remove('cart');

        return $this->redirectToRoute('products');
    }
}
