<?php

namespace App\Controller\Admin;

use App\Entity\Osoby;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OsobyCrudController extends AbstractCrudController
{

    private $photoDir;

    public function __construct(string $photoDir)
    {
        $this->photoDir = $photoDir;
    }
    public static function getEntityFqcn(): string
    {
        return Osoby::class;
    }
    
    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof Osoby && !empty($entityInstance->getPlainPassword()))
            {
                $entityInstance->setPassword('');
            }
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW);
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('imie'),
            TextField::new('nazwisko'),
            'email',
            TextField::new('pesel')->hideOnIndex(),
            TextField::new('nip')->hideOnIndex(),
            TextField::new('adres')->hideOnIndex(),
            TextField::new('plainPassword', 'Nowe hasło')->hideOnIndex(),
            TextareaField::new('opis')->hideOnIndex(),
            TextareaField::new('zainteresowania')->hideOnIndex(),
            TextareaField::new('umiejetnosci')->hideOnIndex(),
            TextareaField::new('doswiadczenie')->hideOnIndex(),
            DateField::new('data_urodzenia')->hideOnIndex(),
            DateField::new('data_rejestracji')
                ->hideOnIndex()
                ->renderAsText()
                ->setFormTypeOptions(['disabled' => 'disabled']),
            DateTimeField::new('data_aktualizacji_wpisu')
                ->hideOnIndex()
                ->renderAsText()
                ->setFormTypeOptions(['disabled' => 'disabled']),
            ChoiceField::new('ocena')->setChoices(array_combine(range(1, 10), range(1,10))),
            ImageField::new('cv')
                    ->setBasePath('uploads') //see documentation about ImageField to understand the difference beetwen setBasePath and setUploadDir
                    ->setUploadDir('public\uploads')
                    ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
                    ->hideOnIndex()
                    ->setFormTypeOptions(['attr' => [
                            'accept' => 'application/pdf'
                        ]
                    ]),
        
    ];
    }
    
}
