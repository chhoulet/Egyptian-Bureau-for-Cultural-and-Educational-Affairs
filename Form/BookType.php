<?php

namespace ArticleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class BookType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,           array('label'=>'Title',
                                                            'attr' => array('class'=>'form-control')))
            ->add('titleArab', TextType::class,       array('label'=>'Title in arab language',
                                                            'attr' => array('class'=>'form-control')))
            ->add('reference', TextType::class,       array('label'=>'Reference',
                                                            'attr' => array('class'=>'form-control')))
            ->add('author', TextType::class,          array('label'=>'Author',
                                                            'attr' => array('class'=>'form-control')))
            ->add('authorArab', TextType::class,      array('label'=>'Author in arab language',
                                                            'attr' => array('class'=>'form-control')))
            ->add('publisher', TextType::class,       array('label'=>'Editor',
                                                            'required'=>false,
                                                            'attr' => array('class'=>'form-control',
                                                                            'placeholder'=>'This field is not compulsory')))
            ->add('yearPublication', DateType::class, array('label'=>'Publication Date',
                                                            'widget'=>'single_text',
                                                            'html5'=>false,
                                                            'required'=>false,                                                   
                                                            'attr'=>array('class' => 'js-datepicker',
                                                                          'placeholder'=>'This field is not compulsory')))
            ->add('pagesNumber', NumberType::class,   array('label'=>'Page number',
                                                            'required'=>false,
                                                            'attr' => array('class'=>'form-control',
                                                                            'placeholder'=>'This field is not compulsory')))
            ->add('copy', NumberType::class,          array('label'=>'Copy number',
                                                            'required'=>false,
                                                            'attr' => array('class'=>'form-control',
                                                                            'placeholder'=>'This field is not compulsory')))
            ->add('available', CheckboxType::class,   array('label'=>'Available',
                                                            'required'=>false,                                                           
                                                            'attr' => array('class'=>'form-control')))
            ->add('desk', CheckboxType::class,        array('label'=>'Is owned by the Office ?',
                                                            'required'=>false,                                                            
                                                            'attr' => array('class'=>'form-control')))
            ->add('submit', SubmitType::class,        array('label'=>'Add',
                                                            'attr' => array('class'=>'btn btn-success')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArticleBundle\Entity\Book'
        ));
    }
}
