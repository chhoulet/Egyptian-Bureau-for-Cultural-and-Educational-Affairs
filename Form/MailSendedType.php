<?php

namespace ArticleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MailSendedType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject', TextType::class, ['label'=>'Subject',
                                               'attr'=>['class'=>'form-control']])
            ->add('message', TextareaType::class, ['label'=>'Your message ...',
                                                   'attr' =>['class'=>'tinymce']])
            ->add('submit', SubmitType::class, array('label'=>'Send the mail',
                                                     'attr'=>['class'=>'btn btn-success']));
        ;
    }
        
}
