<?php

namespace App\Form;

use App\Entity\Osoby;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

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
            ->add('plainPassword', PasswordType::class, [
                'required' => false
            ])
            ->add('opis')
            ->add('zainteresowania')
            ->add('umiejetnosci')
            ->add('doswiadczenie')
            ->add('data_urodzenia', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('cv', FileType::class, [
                'required' => false,
                'data_class' => null,
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
