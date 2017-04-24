<?php

namespace ArticleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MessageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,        array('label'=>'Object :',
                                                         'required'=>false,
                                                         'attr' => array('class'=>'form-control')))
            ->add('name', TextType::class,         array('label'=>'Your Name :',
                                                         'attr' => array('class'=>'form-control')))           
            ->add('message', TextareaType::class,  array('label'=>'Your Message :',
                                                         'attr' => array('class'=>'form-control')))
            ->add('receiver', ChoiceType::class,   array('label'=>'Send to :',
                                                         'choices'=>array('Cultural attaché'=>'1',
                                                                          'Cultural and scientific Attaché'=>'2',
                                                                          'Administrative Attaché'=>'3',
                                                                          'Administrative Secretary'=>'4',
                                                                          'School secretary'=>5),
                                                         'attr' => array('class'=>'form-control')))
            ->add('mail', TextType::class,         array('label'=>'Your Mail :',
                                                         'attr' => array('class'=>'form-control')))
            ->add('submit', SubmitType::class,     array('label'=>'Send',
                                                         'attr' => array('class'=>'btn btn-success')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArticleBundle\Entity\Message'
        ));
    }
}
