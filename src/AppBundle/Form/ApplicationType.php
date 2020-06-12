<?php

namespace AppBundle\Form;

use AppBundle\Application\Application;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApplicationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
                ->add('appKey', null, array(
                'label'=>'Domain',
                "widget_btn_append" => array(
                    array(
                        "type" => "button",
                        "label" => (new Application())->rootdomain,
                        "icon" => 'barcode',
                        "icon_inverted" => false,
                    )
                )))
                ->add('Client', ClientType::class, array(
                        'label'=>'Client',
                        'widget_form_group_attr'=>array(
                            'class'=>'row nested_form'
                            )
                        )
                    );
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Application'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_application';
    }


}
