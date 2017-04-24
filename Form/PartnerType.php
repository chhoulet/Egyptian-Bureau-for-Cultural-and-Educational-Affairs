<?php

namespace ArticleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PartnerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label'=>'Name',
                                                 'attr'=>array('class'=>'form-control')))
            ->add('nameArab', TextType::class, array('label'=>'Name in arab langage',
                                                 'attr'=>array('class'=>'form-control')))
            ->add('description', TextareaType::class, array('label'=>'English Text',
                                                 'attr'=>array('class'=>'tinymce')))
            ->add('descriptionArab', TextareaType::class, array('label'=>'Arabic Text',
                                                 'attr'=>array('class'=>'tinymce')))
            ->add('lien', TextType::class, array('label'=>'Url',
                                                 'attr'=>array('placeholder'=>'Exact Url from: www...',
                                                               'class'=>'form-control'),
                                                 'required'=>false))
            ->add('brochure', FileType::class, array('label'=>'Photo',                                                 
                                                     'required'=>false))
            ->add('Submit', SubmitType::class, array('attr'=>array('class'=>'btn btn-warning')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArticleBundle\Entity\Partner'
        ));
    }
}
