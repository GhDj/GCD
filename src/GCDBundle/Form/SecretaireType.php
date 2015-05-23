<?php

namespace GCDBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SecretaireType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomSecretaire')
            ->add('prenomSecretaire')
            ->add('emailSecretaire')
            ->add('pwSecretaire')
            ->add('telSecretaire')
            ->add('adresseSecretaire')
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
            'data_class' => 'GCDBundle\Entity\Secretaire'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gcdbundle_secretaire';
    }
}
