<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VenteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantite',IntegerType::class,array('attr'=>['class'=>'form-control']))
            ->add('produit',EntityType::class,array(
                'class'=>'AppBundle\Entity\Product',
                'choice_label'=>'nomProduitPrixVente',
                'expanded'=>false,
                'placeholder'=>'-Selectionner-',
                 'attr'=> ['class'=>'form-control','multiple'=>false]));
                 /*
            ->add('PrixVente',MoneyType::class,array('scale'=>2,'currency'=>false,'mapped'=>true))
            ->add('patient',EntityType::class,array(
                'class'=>'AppBundle\Entity\patient',
                'choice_label'=>'nom',
                'expanded'=>false,
                'placeholder'=>'-Selectionner-',
                'multiple'=>false,
               'attr'=> ['class'=>'chosen-select','multiple'=>false],))*/



    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Vente'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_vente';
    }


}
