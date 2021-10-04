<?php
namespace App\Classe ;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Cart 
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