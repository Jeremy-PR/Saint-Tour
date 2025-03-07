<?php

namespace App\Controller\Admin;

use App\Entity\Lieu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use Symfony\Component\HttpFoundation\File\File;

class LieuCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Lieu::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name', 'Nom du lieu'),
            TextField::new('adresse', 'Adresse du lieu'),
            NumberField::new('latitude', 'Latitude du lieu')->setNumDecimals(6),
            NumberField::new('longitude', 'Longitude du lieu')->setNumDecimals(5),
            TextareaField::new('description', 'Description du lieu'),
            AssociationField::new('categories', 'Catégories')->setFormTypeOption('multiple', true),
            // ->setFormTypeOption('by_reference', false),
            ImageField::new('image')
                ->setBasePath('uploads/images') // Le chemin vers le dossier où les images seront stockées
                ->setUploadDir('public/uploads/images') // Dossier où les images seront envoyées
                ->setRequired(false), // Indiquer si ce champ est obligatoire ou non
         
        ];
    }
}
