<?php

namespace App\Form;

use App\Entity\Driver;
use App\Entity\Rental;
use App\Entity\Vehicle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RentalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('conducteur',EntityType::class,[
                'class'=>Driver::class,
                'choice_label'=>'firstName'
            ])
            ->add('vehicule',EntityType::class,[
                'class'=>Vehicle::class,
                'choice_label'=>'brand'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rental::class,
        ]);
    }
}
