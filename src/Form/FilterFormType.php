<?php

namespace App\Form;

use App\Entity\Activity;
use App\Entity\ActivityDomain;
use App\Entity\ContractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contract', EntityType::class,[
                'label' => false,
                'required'=> false,
                'class' => ContractType::class,
                'expanded' => true,
                'multiple' => true
            ])
            ->add('activity', EntityType::class,[
                'label' => false,
                'required'=> false,
                'class' => Activity::class,
                'expanded' => true,
                'multiple' => true
            ])
            ->add('domain', EntityType::class,[
                'label' => false,
                'required'=> false,
                'class' => ActivityDomain::class,
                'expanded' => true,
                'multiple' => true
            ])
            ->add('level', CheckboxType::class,[
                'label' => 'Niveau professionnel inférieur',
                'required'=> false,
            ])
            ->add('rechercher', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }
}
