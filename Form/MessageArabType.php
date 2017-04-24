<?php

namespace ArticleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MessageArabType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,        array('label'=>'الموضوع',
                                                         'attr' => array('class'=>'form-control')))
            ->add('name', TextType::class,         array('label'=>'الاسم',
                                                         'attr' => array('class'=>'form-control')))           
            ->add('message', TextareaType::class,  array('label'=>'الرسالة',
                                                         'attr' => array('class'=>'form-control')))
            ->add('receiver', ChoiceType::class,   array('label'=>'توجيه الرسالة إلى',
                                                         'choices'=>array('المستشار الثقافي'=>'1',
                                                                          'الملحق الثقافي والعلمي'=>'2',
                                                                          'الملحق الإداردي'=>'3',
                                                                          'السكرتاريا'=>'4',
                                                                          'سكرتاريا المدرسة'=>5),
                                                         'attr' => array('class'=>'form-control')))
            ->add('mail', TextType::class,         array('label'=>'البريد الالكتروني',
                                                         'attr' => array('class'=>'form-control')))
            ->add('submit', SubmitType::class,     array('label'=>'إرسال',
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
