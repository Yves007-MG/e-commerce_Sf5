<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname',TextType::class,[
                "label"=>'votre nom :',
                
            ])

            ->add('lastname',TextType::class,[
                "label"=>'votre prenom :'
            ])
            
            ->add('email',EmailType::class,[
                "label"=>'E-mail'
            ])
          
            ->add('password',RepeatedType::class,[
                "type"=>PasswordType::class,
                "invalid_message"=>"le mot de passe et la confirmation doivent etre identique",
                "label"=>"Votre mot de passe",
                "required"=>true,
                "first_options"=>["label"=>"votre mot de passe"],
                "second_options"=>["label"=>"confirmez votre mot de passe"],

            ])

            ->add('submit',SubmitType::class,[
                "label"=>"s'inscrire"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
