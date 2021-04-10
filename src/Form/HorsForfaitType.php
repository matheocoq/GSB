<?php

namespace App\Form;

use App\Entity\HorsForfait;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;



class HorsForfaitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date',DateType::class, array(
                'widget' => 'choice',
                'years' => range(date('Y')-1, date('Y')),
                'months' => range(1, 12),
                'days' => range(1, 30),
            ))
            ->add('libelle')
            ->add('numFacture')
            ->add('montant');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HorsForfait::class,
        ]);
    }
}
