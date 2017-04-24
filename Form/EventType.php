<?php

namespace ArticleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EventType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label'=>'Arabic Name',
                                                 'attr'=>array('class'=>'form-control')))
            ->add('dateEvent', DateType::class, array('label'=>'Date',
                                                      'widget' => 'single_text',
                                                      'html5'=>false,
                                                      'attr' => ['class' => 'js-datepicker']))
            ->add('description', TextareaType::class, array('label'=>'Arabic Text',
                                                            'attr'=>array('class'=>'tinymce')))
            ->add('place', TextType::class, array('label'=>'Place in arab language',
                                                  'attr'=>array('class'=>'form-control')))            
            ->add('Submit', SubmitType::class, array('attr'=> array('class'=>'btn btn-success')))
            /*->add('program')*/
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArticleBundle\Entity\Event'
        ));
    }
}
