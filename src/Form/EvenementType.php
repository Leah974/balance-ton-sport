<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;



class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('organisateur', TextType::class)
            ->add('titre', TextType::class)
            ->add('description', TextareaType::class)
            ->add('statut', CheckboxType::class, array(
                    'label' => ' ',
                    'required' => false
                ))
            ->add('date_evenement', DateType::class, array(
                    'widget' => 'single_text',
                ))
            ->add('heure_debut', TimeType::class, array(
                'input'  => 'datetime',
                'widget' => 'choice'
                ))
            ->add('heure_fin', TimeType::class, array(
                'input'  => 'datetime',
                'widget' => 'choice'
                ))
            ->add('inscription', CheckboxType::class, array(
                    'label' => ' ',
                    'required' => false
                ))
            ->add('participant_min', ChoiceType::class,
                array(
                'choices' => range(1,50),
                'label' => ' ',   
            ))
            ->add('participant_max', ChoiceType::class,
                array(
                'choices' => range(1,50),
                'label' => ' ',   
            ))
            ->add('code_postal', IntegerType::class, array(
                'min' => 5,
                'max' => 5 
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