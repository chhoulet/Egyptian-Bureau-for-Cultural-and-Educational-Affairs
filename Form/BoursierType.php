<?php

namespace ArticleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BoursierType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label'=>'اسم العائلة',
                                                        'attr'=>array('class'=>'form-control')))
            ->add('firstname', TextType::class, array('label'=>'الاسم',
                                                        'attr'=>array('class'=>'form-control')))
            ->add('adress', TextType::class, array('label'=>'العنوان',
                                                        'attr'=>array('class'=>'form-control')))
            ->add('postcode', TextType::class, array('label'=>'الرمز البريدي',
                                                        'attr'=>array('class'=>'form-control')))
            ->add('city', TextType::class, array('label'=>'المدينة',
                                                        'attr'=>array('class'=>'form-control')))
            ->add('telfix', NumberType::class, array('label'=>'تليفون أرضي',
                                                        'required'=>false,
                                                        'attr'=>array('class'=>'form-control')))
            ->add('telpor', NumberType::class, array('label'=>'تلفون محمول',
                                                        'required'=>false,
                                                        'attr'=>array('class'=>'form-control')))
            ->add('telegy', NumberType::class, array('label'=>'تليفون في مصر',
                                                        'required'=>false,
                                                        'attr'=>array('class'=>'form-control')))
            ->add('arrivalDate', DateType::class, array('label'=>'تاريخ الوصول إلى بلد البعثة',
                                                        'widget'=>'single_text',
                                                        'html5'=>false,                                                   
                                                        'attr'=>array('class' => 'js-datepicker')))
            ->add('birthDate', DateType::class, array('label'=>'تاريخ الميلاد',
                                                        'widget'=>'single_text',
                                                        'html5'=>false,                                                        
                                                        'attr'=>array('class' => 'js-datepicker')))
            ->add('domain', TextType::class, array('label'=>'مجال الدراسة أو البحث',
                                                        'attr'=>array('class'=>'form-control')))
            ->add('subject', TextType::class, array('label'=>'موضوع الدراسة أو البحث',
                                                        'attr'=>array('class'=>'form-control')))
            ->add('universityEgypt', TextType::class, array('label'=>'جامعة أو هيئة الارتباط في مصر',
                                                        'attr'=>array('class'=>'form-control')))
            ->add('universityFrench', TextType::class, array('label'=>'جامعة أو هيئة الدراسة والبحث في بلد الإيفاد',
                                                        'attr'=>array('class'=>'form-control')))
            ->add('comment', TextareaType::class, array('label'=>'تعليق',
                                                        'required'=> false,
                                                        'attr'=>array('class'=>'form-control')))
            ->add('Submit', SubmitType::class,array('attr'=>array('class'=>'btn btn-success')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArticleBundle\Entity\Boursier'
        ));
    }
}
