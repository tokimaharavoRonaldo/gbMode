<?php

namespace App\Controller\Admin;

use App\Entity\Vetement;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class VetementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vetement::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('description'),
            TextField::new('taille'),
      
            BooleanField::new('dispo'),
            NumberField::new('prix'),
            TextField::new('imageFile')->setFormType(VichImageType::class)->onlyWhenCreating(),
            ImageField::new('file')->setBasePath('/image/')->onlyOnIndex(),
            SlugField::new('slug')->setTargetFieldName('nom')->hideOnIndex(),
            AssociationField::new('categorie'),
            

        ];
    }

    // public function configureCrud(Crud $crud): Crud
    // {
    //     return $crud
    //     ->setDefaultSort(['created_at' => 'DESC']);
        
    // }
    
}
