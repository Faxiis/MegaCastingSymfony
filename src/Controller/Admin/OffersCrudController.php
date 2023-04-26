<?php

namespace App\Controller\Admin;

use App\Entity\Offers;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\LocaleField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OffersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Offers::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('label', 'Nom de l\'offre'),
            TextField::new('reference', 'Référence'),
            TextEditorField::new('description', 'Description'),
            DateTimeField::new('parutionDateTime', 'Date de parution'),
            DateTimeField::new('offerStartDate', 'Date de début de l\'offre'),
            DateTimeField::new('offerEndDate', 'Date de fin de l\'offre'),
            TextField::new('localisation', 'Localisation'),
            AssociationField::new('civilities', 'Sexes')->hideOnIndex(),
            AssociationField::new('contractTypes', 'Type de contrat')->hideOnIndex(),
            AssociationField::new('clients', 'Clients')->hideOnIndex(),
            BooleanField::new('sponsor', 'Est sponsorisé'),
        ];
    }

}
