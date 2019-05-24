<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class OperationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Montant',MoneyType::class,array('scale'=>2,'currency'=>false,'mapped'=>true,'attr'=>['class'=>'form-control']))
        ->add('service',EntityType::class,array(
                'class'=>'AppBundle\Entity\Service',
                'choice_label'=>'nom',
                'expanded'=>false,
                'placeholder'=>'-Selectionner-',
                 'attr'=> ['class'=>'form-control','multiple'=>false]))
        ->add('typeOperation',EntityType::class,array(
                'class'=>'AppBundle\Entity\TypeOperation',
                'choice_label'=>'nom',
                'expanded'=>false,
                'placeholder'=>'-Selectionner-',
                 'attr'=> ['class'=>'form-control','multiple'=>false]));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Operation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_operation';
    }


}
