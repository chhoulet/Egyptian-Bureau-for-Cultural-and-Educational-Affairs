<?php

namespace ArticleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MailType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mail', TextType::class, array('label'=>'Mail',
                                                 'attr' => array('class'=>'form-control')))
            ->add('name', TextType::class, array('label'=>'Name',
                                                 'required'=>false,
                                                 'attr' => array('class'=>'form-control')))
            ->add('firstname', TextType::class, array('label'=>'Firstname',
                                                      'required'=>false,
                                                      'attr' => array('class'=>'form-control')))
            ->add('job', TextType::class, array('label'=>'Job',
                                                'required'=>false,
                                                'attr' => array('class'=>'form-control')))
            ->add('event', ChoiceType::class, array('label'=>'You are interested by',
                                                    'choices'=>array('Activities Arab'=>1,
                                                                     'Activities English'=>2,
                                                                     'Both'=>3),                                                 
                                                    'attr' => array('class'=>'form-control')))
            ->add('Submit', SubmitType::class, array('attr'=>array('class'=>'btn btn-info')))
            ->add('unSubscribe', SubmitType::class, array('label' => 'Unsubscribe',
                                                          'attr'=> array('class'=>'btn btn-warning')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArticleBundle\Entity\Mail'
        ));
    }
}
