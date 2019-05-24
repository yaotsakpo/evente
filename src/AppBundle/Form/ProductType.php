<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomProduit',TextType::class,array('attr'=>['class'=>'form-control']))
            ->add('quantiteProduit',IntegerType::class,array('attr'=>['class'=>'form-control']))
            ->add('prixAchat',MoneyType::class,array('scale'=>2,'currency'=>false,'attr'=>['class'=>'form-control']))
            ->add('prixVente',MoneyType::class,array('scale'=>2,'currency'=>false,'attr'=>['class'=>'form-control']))
            ->add('stockMinimum',IntegerType::class,array('attr'=>['class'=>'form-control']))
            ->add('categorie',EntityType::class,array(
                'class'=>'AppBundle\Entity\Categorie',
                'choice_label'=>'LibelleCategorie',
                'placeholder'=>'-Selectionner-',
                'expanded'=>false,
                'multiple'=>false,
                'attr'=> ['class'=>'form-control','multiple'=>false],
            )
            );

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_product';
    }


}
