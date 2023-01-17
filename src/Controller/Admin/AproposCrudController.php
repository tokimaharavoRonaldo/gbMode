<?php

namespace App\Controller\Admin;

use App\Entity\Apropos;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;

class AproposCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Apropos::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            TextField::new('titre'),
            TextField::new('description'),
            TextField::new('contact'),
            TextField::new('facebook'),
            EmailField::new('email'),
            // TextEditorField::new('description'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ->disable(Action::DELETE,Action::NEW);
    }
    
}
