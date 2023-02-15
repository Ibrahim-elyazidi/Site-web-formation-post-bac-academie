<?php

namespace App\Form;

use App\Entity\FormationEtablissement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationEtablissementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('siteWeb')
            ->add('formation',EntityType::Formation,[
                'Formation'=> User::Formation,
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('u')
                    ->orderBy('u.formation','ASC');
                },
                'choice_label' => 'formation',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FormationEtablissement::class,
        ]);
    }
}
