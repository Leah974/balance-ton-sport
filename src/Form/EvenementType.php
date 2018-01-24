<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;



class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class)
            ->add('description', TextareaType::class)
            ->add('photo', FileType::class)
            ->add('statut', TextType::class)
            ->add('statut', ChoiceType::class, array(
                    'choices' => array(
                    'privé' => false,
                    'public' => true,
                    ))
                )
            ->add('heuredebut', TimeType::class, array(
                    'input'  => 'datetime',
                    'widget' => 'choice',
                    'placeholder' => array('hour' => '17', 'minute' => '00'),
                ))
            ->add('heurefin', TimeType::class, array(
                    'input'  => 'datetime',
                    'widget' => 'choice',
                    'placeholder' => array('hour' => '20', 'minute' => '00'),
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Evenement::class,
        ));
    }
}