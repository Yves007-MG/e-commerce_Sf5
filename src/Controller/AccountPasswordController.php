<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountPasswordController extends AbstractController
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) {

        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/compte/modifier-mot-de-passe", name="account_password")
     */
    public function index(Request $request,UserPasswordHasherInterface $encoder)
    {
        $notification = null;
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $old_password = $form->get('old_password')->getData();

            if ($encoder->isPasswordValid($user,$old_password)){
                $newPassword = $form->get('new_password')->getData();
                $password = $encoder->hashPassword($user,$newPassword);
                $user->setPassword($password);
                $this->entityManager->flush();
                $notification = "votre mot de passe a ete mis a jour !";
                $this->addFlash("succes","votre mot de passe a ete mis a jour !");
                return $this->redirectToRoute('account');

            }else{
                $notification = "mot de passe actuel non valide";
            }


        }

        return $this->render('account/password.html.twig',[
            "form"=>$form->createView(),
            "notification"=>$notification
        ]);
    }

}
