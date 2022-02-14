<?php

namespace App\Form;

use App\Entity\Musico;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MusicoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idSocio')
            ->add('Nombre')
            ->add('primerApellido')
            ->add('segundoApellido')
            ->add('DNI')
            ->add('idInstrumento')
            ->add('idBanda')
            ->add('idAlumno')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Musico::class,
        ]);
    }
}
