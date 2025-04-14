<?php
namespace App\Controller\Admin;

use App\Entity\Avis;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class AvisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Avis::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('commentaire', 'Commentaire'),
            NumberField::new('note', 'Note')->setHelp('La note doit être entre 1 et 5'),
            DateTimeField::new('created_at', 'Date de création')->setFormat('dd/MM/yyyy HH:mm'),
            AssociationField::new('user', 'Utilisateur'),
            AssociationField::new('itineraire', 'Itinéraire associé'),
        ];
    }
}