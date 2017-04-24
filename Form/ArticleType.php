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

class ArticleType extends AbstractType
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
            ->add('titleArab', TextType::class,      array('label'=>'Arabic Title',
                                                       'attr' => array('class'=>'form-control',
                                                                       'placeholder'=>'This field is not compulsory'),
                                                       'required'=>false))
            ->add('main', TextareaType::class,   array('label'=>'English Text',
                                                       'attr' => array('class'=>'tinymce')))
            ->add('mainArab', TextareaType::class, array('label'=>'Arabic Text ',
                                                         'attr' => array('class'=>'tinymce',
                                                                         'plugins'=>'directionality',
                                                                         'toolbar'=>'ltr rtl')))
            ->add('author', TextType::class,     array('label'=>'Author',
                                                       'attr' => array('class'=>'form-control',
                                                                       'placeholder'=>'This field is not compulsory'),
                                                       'required'=>false))
            ->add('photo', FileType::class,     array('label'=>'Photo (file png-jpg-jpeg)',
                                                      'required'=>false,
                                                      'data_class' => null))    
            ->add('filename', FileType::class,     array('label'=>'Photo N°2 (file png-jpg-jpeg)',
                                                      'required'=>false,
                                                      'data_class' => null))          
            ->add('submit', SubmitType::class,   array('label'=>'Send',
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
