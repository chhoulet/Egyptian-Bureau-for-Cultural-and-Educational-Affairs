<?php

namespace ArticleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MailArabType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mail', TextType::class, array('label'=>'عنوان البريد الالكتروني',
                                                 'attr' => array('class'=>'form-control')))
            ->add('name', TextType::class, array('label'=>'اسم العائلة',
                                                 'required'=>false,
                                                 'attr' => array('class'=>'form-control')))
            ->add('firstname', TextType::class, array('label'=>'الاسم الأول',
                                                      'required'=>false,
                                                      'attr' => array('class'=>'form-control')))
            ->add('job', TextType::class, array('label'=>'المهنة',
                                                'required'=>false,
                                                'attr' => array('class'=>'form-control')))
            ->add('event', ChoiceType::class, array('label'=>'المهنة',
                                                    'choices'=>array('نشاطات باالغة العربية'=>'1',
                                                                     'نشاطات باللغة الإنجليزية'=>'2',
                                                                     'كل النشاطات'=>'3'),                                                  
                                                    'attr' => array('class'=>'form-control')))
            ->add('Go', SubmitType::class, array('label'=>'تأكيد الانضمام للقائمة البريدية',
                                                                           'attr'=>array('class'=>'btn btn-info')))
            ->add('Delete', SubmitType::class, array('label'=>'إلغاء الانضمام للقائمة البريدية',
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
