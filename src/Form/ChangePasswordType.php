<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
                "disabled"=>true,
                "label"=>"E-mail",
            ])
            ->add('Firstname',TextType::class,[
                "disabled"=>true,
                "label"=>"Nom"
                ])
            ->add('Lastname',TextType::class,[
                    "disabled"=>true,
                    "label"=>"Prenom",
                    ])
            ->add('old_password',PasswordType::class,[
                "label"=> "votre mot de passe actuel",
                "mapped"=>false
            ])
            ->add('new_password',RepeatedType::class,[
                "type"=>PasswordType::class,
                "mapped"=>false,
                "invalid_message"=>"le mot de passe et la confirmation doivent etre identique",
                "label"=>"Votre nouveaux mot de passe",
                "required"=>true,
                "first_options"=>["label"=>"votre nouveaux  mot de passe"],
                "second_options"=>["label"=>"confirmez votre  nouveaux mot de passe"],

            ])
            ->add('submit',SubmitType::class,[
                "label"=>"mettre a jour"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
