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
            ->add('nom', TextType::class, array('required' => false))
            ->add('prenom', TextType::class, array('required' => false))
            ->add('telephone', TextType::class, array('required' => false))
            ->add('dte_naissance', BirthdayType::class, array('years' => range(date('Y') - 90, date('Y') - 0)))
            ->add('sport_favori', TextType::class, array('required' => false))
            ->add('photo', FileType::class, array('required' => false,
                                                  'data_class' => null
                                                ))
            ->add('sexe', ChoiceType::class, array(
                            'choices'  => array(
                                    'Homme' => 'm',
                                    'Femme' => 'f'), 'required' => false
                                            ))
            ->add('ville', TextType::class, array('required' => false))
            ->add('mini_bio', TextareaType::class, array('required' => false))
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