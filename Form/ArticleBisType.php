<?php

namespace ArticleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ArticleBisType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,      array('label'=>'English Title',
                                                       'attr' => array('class'=>'form-control',
                                                                       'placeholder'=>'This field is not compulsory'),
                                                       'required'=>false))                        
            ->add('subject', TextType::class,    array('label'=>'English Subject',
                                                       'required'=>false,
                                                       'attr' => array('class'=>'form-control',
                                                                       'placeholder'=>'This field is not compulsory')))   
            ->add('main', TextareaType::class,       array('label'=>'English text',
                                                           'attr' => array('class'=>'tinymce')))
            ->add('titleArab', TextType::class,      array('label'=>'Arabic Title',
                                                           'attr' => array('class'=>'form-control',
                                                                           'placeholder'=>'This field is not compulsory'),
                                                           'required'=>false))                        
            ->add('subjectArab', TextType::class,    array('label'=>'Arabic subject ',
                                                           'required'=>false,
                                                           'attr' => array('class'=>'form-control',
                                                                           'placeholder'=>'This field is not compulsory')))   
            ->add('mainArab', TextareaType::class,       array('label'=>'Arabic text',
                                                               'attr' => array('class'=>'tinymce',
                                                                               'plugins'=>'directionality',
                                                                               'toolbar'=>'ltr rtl')))
            ->add('author', TextType::class,     array('label'=>'Author',
                                                       'attr' => array('class'=>'form-control',
                                                                       'placeholder'=>'This field is not compulsory'),
                                                       'required'=>false))
            ->add('selected', CheckboxType::class,   array('label'=>'In homepage ?',
                                                           'required'=>false,                        
                                                           'attr' => array('class'=>'form-control')))
            ->add('photo', FileType::class,     array('label'=>'Photo (file png-jpg-jpeg)',
                                                      'required'=>false,
                                                      'data_class' => null))
            ->add('filename', FileType::class,     array('label'=>'Photo N° 2 (file png-jpg-jpeg)',
                                                      'required'=>false,
                                                      'data_class' => null))
            ->add('submit', SubmitType::class, array('label'=>'Submit',
                                                     'attr' => array('class'=>'btn btn-success')))                        
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArticleBundle\Entity\Article'
        ));
    }
}
