<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


// les Types servent à créer des formulaires
// Ici le UserInfosType sert à créer le formulaire pour ajouter les informations personnelles d'un membre (user)

class UserInfosType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('telephone', TextType::class)
            ->add('dte_naissance', BirthdayType::class)
            ->add('sport_favori', TextType::class)
            ->add('photo', FileType::class, array('required' => false,
                                                  'data_class' => null
                                                ))
            ->add('sexe', ChoiceType::class, array(
                            'choices'  => array(
                                    'Homme' => 'm',
                                    'Femme' => 'f')
                                            ))
            ->add('ville', TextType::class)
            ->add('mini_bio', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
            'validation_groups' => false,
        ));
    }
}