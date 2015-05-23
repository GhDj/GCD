<?php

namespace GCDBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DentisteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomDentiste')
            ->add('prenomDentiste')
            ->add('emailDentiste')
            ->add('password')
            ->add('adresseDentiste')
            ->add('telDentiste')
            ->add('adresseCabinet')
            ->add('telCabinet')
            ->add('sexe','choice',array('choices' => array('h' => 'Homme', 'f' => 'Femme'),
            'expanded'=>true,
            'label_attr' => array('class' => 'radio inline')
            ))
            
            ->add('inscrire','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GCDBundle\Entity\Dentiste'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gcdbundle_dentiste';
    }
}
