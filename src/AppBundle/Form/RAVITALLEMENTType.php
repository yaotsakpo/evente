<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RAVITALLEMENTType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('quantite',IntegerType::class,array('attr'=>['class'=>'form-control']))

        ->add('product',EntityType::class,array(
                      'class'=>'AppBundle\Entity\Product',
                      'choice_label'=>'nomProduitPrixVente',
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
            'data_class' => 'AppBundle\Entity\RAVITALLEMENT'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_ravitallement';
    }


}
