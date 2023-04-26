<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            EmailField::new('email'),
            TextField::new('password', 'Mot de passe')->hideOnIndex(),
            TextField::new('lastName', 'Nom'),
            TextField::new('firstName', 'Prénom'),
            TextField::new('phone', 'Téléphone'),
            TextField::new('country', 'Pays'),
            TextField::new('city', 'Ville'),
            TextField::new('address', 'Adresse'),
            TextField::new('addressZipCode', 'Code postal'),
            BooleanField::new('isVerified', 'Vérifier'),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof User) return;

        $entityInstance->setUpdatedAt(new \DateTimeImmutable());

        parent::persistEntity($entityManager, $entityInstance);
    }


}
