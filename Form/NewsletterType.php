<?php

namespace ArticleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use ArticleBundle\Repository\ArticleRepository;

class NewsletterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array('label'=>'Title',
                                                  'attr'=>array('class'=>'form-control')))
            ->add('author', TextType::class, array('label'=>'Author',
                                                  'attr'=>array('class'=>'form-control',
                                                                'placeholder'=>'This field is not compulsory'),
                                                  'required'=>false))            
            ->add('main1', TextareaType::class, array('label'=>'Text N° 1',
                                                  'attr'=>array('class'=>'tinymce'),
                                                  'required'=>false))
            ->add('main2', TextareaType::class, array('label'=>'Text N° 2',
                                                  'attr'=>array('class'=>'tinymce',
                                                                'placeholder'=>'This field is not compulsory'),
                                                  'required'=>false))
            ->add('main3', TextareaType::class, array('label'=>'Text N° 3',
                                                  'attr'=>array('class'=>'tinymce',
                                                                'placeholder'=>'This field is not compulsory'),
                                                  'required'=>false))
            ->add('article', EntityType::class, array('label'=>'Add a article ?',
                                                      'class'=>'ArticleBundle:Article',
                                                      'choice_label'=>"title",
                                                      'multiple'=>true,
                                                      'query_builder'=>function(ArticleRepository $er)
                                                        {
                                                            return $er->createQueryBuilder('q')
                                                                      ->orderBy('q.dateCreated','ASC');
                                                        },
                                                      'attr'=>array('class'=>'form-control'),
                                                      'required'=>false))
            ->add('Submit',SubmitType::class,array('attr'=>array('class'=>'btn btn-success')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArticleBundle\Entity\Newsletter'
        ));
    }
}
