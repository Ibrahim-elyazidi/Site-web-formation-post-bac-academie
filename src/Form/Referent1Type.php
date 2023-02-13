<?php

namespace App\Form;

use App\Entity\Referent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Referent1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomReferent')
            ->add('prenomReferent')
            ->add('mailReferent')
            ->add('telephoneReferent')
            ->add('etablissement')
            ->add('formation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Referent::class,
        ]);
    }
}
