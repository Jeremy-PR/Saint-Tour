<?php

namespace App\Controller\Admin;

use App\Entity\Itineraire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ItineraireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Itineraire::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name', 'Nom de l\'itinéraire'),
            TextEditorField::new('description'),
            AssociationField::new('lieux', 'Lieux de l\'itinéraire')
                ->setFormTypeOption('by_reference', false)
                ->setCrudController(LieuCrudController::class)
                ->setHelp('Sélectionnez les lieux par lesquels passe cet itinéraire'),
             

                AssociationField::new('categories'),
        ];
    }
}