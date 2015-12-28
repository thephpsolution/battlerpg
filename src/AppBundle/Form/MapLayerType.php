<?php
/**
 * Created by PhpStorm.
 * User: jmac
 * Date: 12/28/15
 * Time: 1:28 PM
 */

namespace AppBundle\Form;


use AppBundle\Entity\MapLayer;
use AppBundle\Entity\MapPointSet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MapLayerType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pointSets', CollectionType::class, [
                'entry_type' => MapPointSetType::class,
                'entry_options' => [
                    'required' => true
                ]
            ])
            ->add('name')
            ->add('title')
            ->add('hash')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => MapLayer::class
        ));
    }
}