<?php

namespace App\Controller\Admin;

use App\Entity\Osoby;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OsobyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Osoby::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('fullName'),
            EmailField::new('email'),
        ];
    }
    
}
