<?php

namespace ArticleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CounseillorType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,        array('label'=>'Name',
                                                        'attr' => array('class'=>'form-control')))
            ->add('nameArab', TextType::class,        array('label'=>'Arabic Name',
                                                        'attr' => array('class'=>'form-control')))
            ->add('firstName', TextType::class,   array('label'=>'FirstName',
                                                        'attr' => array('class'=>'form-control')))
            ->add('firstNameArab', TextType::class,   array('label'=>'Arabic FirstName',
                                                        'attr' => array('class'=>'form-control')))
            ->add('job', TextType::class,         array('label'=>'Function',
                                                        'attr' => array('class'=>'form-control')))
            ->add('jobArab', TextType::class,         array('label'=>'Arabic Function',
                                                        'attr' => array('class'=>'form-control')))
            ->add('phone', IntegerType::class,    array('label'=>'Phone',
                                                        'attr' => array('class'=>'form-control',
                                                        'require' => false)))
            ->add('fax', IntegerType::class,      array('label'=>'Fax',
                                                        'attr' => array('class'=>'form-control',
                                                        'require' => false)))                                         
            ->add('mail', TextType::class,        array('label'=>'Mail',
                                                        'attr' => array('class'=>'form-control',
                                                        'require' => false)))
            ->add('description', TextareaType::class, array('label'=>'Description',
                                                            'attr' => array('class'=>'tinymce')))
            ->add('descriptionArab', TextareaType::class, array('label'=>'Arabic Text',
                                                                'attr' => array('class'=>'tinymce')))
            ->add('hierarchicLevel', ChoiceType::class, array('label'=>'Hierarchic Level',
                                                              'attr' => array('class'=>'form-control'),      
                                                              'choices'=>array('Director'=>1,
                                                                               'Hierarchic Level 2'=>2,
                                                                               'Hierarchic Level 3'=>3,
                                                                               'Hierarchic Level 4'=>4,
                                                                               'Hierarchic Level 5'=>5,
                                                                               'Hierarchic Level 6'=>6,
                                                                               'Hierarchic Level 7'=>7,
                                                                               'Hierarchic Level 8'=>8,
                                                                               'Hierarchic Level 9'=>9,
                                                                               'Hierarchic Level 10'=>10,
                                                                               'Hierarchic Level 11'=>11,
                                                                               'Hierarchic Level 12'=>12,
                                                                               'Hierarchic Level 13'=>13,
                                                                               'Hierarchic Level 14'=>14,
                                                                               'Hierarchic Level 15'=>15,
                                                                               'Hierarchic Level 16'=>16,
                                                                               'Hierarchic Level 17'=>17,
                                                                               'Hierarchic Level 18'=>18,
                                                                               'Hierarchic Level 19'=>19,
                                                                               'Hierarchic Level 20'=>20)))           
            ->add('image', FileType::class, array('label'=>'Select an image',
                                                  'required'=>false,
                                                  'data_class' => null))            
            ->add('active', CheckboxType::class,  array('label'=>'Today in activity ?',
                                                        'required'=>false))
            ->add('Submit', SubmitType::class,   array('attr'=>array('class'=>'btn btn-success')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArticleBundle\Entity\Counseillor'
        ));
    }
}
