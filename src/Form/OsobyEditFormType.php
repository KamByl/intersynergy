<?php

namespace App\Form;

use App\Entity\Osoby;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OsobyEditFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('imie')
            ->add('nazwisko')
            ->add('pesel')
            ->add('nip')
            ->add('adres')
            ->add('email', EmailType::class)
            ->add('haslo')
            ->add('opis')
            ->add('zainteresowania')
            ->add('umiejetnosci')
            ->add('doswiadczenie')
            ->add('data_urodzenia', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('data_rejestracji', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('data_aktualizacji_wpisu')
            ->add('ocena', ChoiceType::class, [
                'choices'  => array_combine(range(1, 10), range(1,10))
                ])
            ->add('cv', FileType::class, [
                'required' => false,
            ])
            ->add('save', SubmitType::class, ['label' => 'Zapisz dane'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Osoby::class,
        ]);
    }
}
