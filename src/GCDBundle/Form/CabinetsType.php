<?php

namespace GCDBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CabinetsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomCabinet')
            ->add('adresseCabinet')
            ->add('telCabinet')
            ->add('nomDentiste')
            ->add('horraireOuverture')
            ->add('horraireFermeture')
            ->add('inscrire','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GCDBundle\Entity\Cabinets'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gcdbundle_cabinets';
    }
}
