<?php

namespace GCDBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PatientType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomPatient')
            ->add('prenomPatient')
            ->add('dateNaiss')
            ->add('adressePatient')
            ->add('telPatient')
            ->add('cnam')
            ->add('sexe','choice',array('choices' => array('h' => 'Homme', 'f' => 'Femme'),
            'expanded'=>true,
            'label_attr' => array('class' => 'radio inline')
            ))
            ->add('emailPatient')
            ->add('pwPatient','password')
            ->add('idFiche')
            ->add('inscrire','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GCDBundle\Entity\Patient'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gcdbundle_patient';
    }
}
