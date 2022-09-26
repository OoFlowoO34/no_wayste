<?php

namespace App\Form;

use App\Form\FavoriteType;
use App\Entity\HomeProduct;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HomeProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('hp_scan_date')
            ->add('hp_use_by_date')
            ->add('hp_consumed')
            ->add('product')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HomeProduct::class,
        ]);
    }
}
