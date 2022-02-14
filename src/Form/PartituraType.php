<?php

namespace App\Form;

use App\Entity\Partitura;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartituraType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rolInstrumento')
            ->add('fichero')
            ->add('idPieza')
            ->add('idInstrumento')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Partitura::class,
        ]);
    }
}
