<?php
namespace App\Service ;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartSold 
{
    private $session;
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function add($id){
          dd($id);
        $this->session->set('cart',[
            [
                "id"=>$id,
                "quantity"=>1,
            ]
        ]);
    }

}