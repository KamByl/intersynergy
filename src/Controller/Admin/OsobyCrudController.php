<?php

namespace App\Controller\Admin;

use App\Entity\Osoby;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
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
            IdField::new('id')->hideOnForm(),
            'imie',
            'nazwisko',
            'email',
            'pesel',
            'nip',
            'adres',
            'password',
            'opis',
            'zainteresowania',
            'umiejetnosci',
            'doswiadczenie',
            'data_urodzenia',
            'data_rejestracji',
            'data_aktualizacji_wpisu',
            ChoiceField::new('ocena')->setChoices(array_combine(range(1, 10), range(1,10))),
            'cv',
        ];
    }
    
}
