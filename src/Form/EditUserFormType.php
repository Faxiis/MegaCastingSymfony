<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Vich\UploaderBundle\Form\Type\VichImageType;

class EditUserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom de famille'
            ])
            ->add('profesionalLevel', ChoiceType::class, [
                'label' => 'Niveau professionel',
                'choices'  =>
             [
                 'Débutant' => 1,
                 'Intermediaire' => 2,
                 'Expert' => 3,
             ],
            ])
            ->add('email')
            ->add('phone', TextType::class, [
                'label' => 'Téléphone'
            ])
            ->add('country', TextType::class, [
                'label' => 'Pays'
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville'
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse'
            ])
            ->add('addressZipCode', TextType::class, [
                'label' => 'Code postal'
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Photo de profil',
                'required' => false,
                'image_uri' => false,
                'delete_label' => 'Supprimer l\'image',
                'download_label' => 'Télécharger l\'image',
                'download_uri' => true,
            ])
            ->add('Sauvegarder', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
