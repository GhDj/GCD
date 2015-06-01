<?php

namespace GCDBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RdvType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateRdv','date',array(
                            'widget' => 'single_text',
                            'format' => 'yyyy-MM-dd',))
            ->add('horraireRdv','time')
            ->add('idPatient')
            ->add('Ajouter','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GCDBundle\Entity\Rdv'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gcdbundle_rdv';
    }
}
