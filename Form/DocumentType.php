<?php

namespace ArticleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DocumentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label'=> 'Name',
                                                 'attr' => array('class'=>'form-control')))
            ->add('description', TextareaType::class, array('label'=> 'Description',
                                                        'attr' => array('class'=>'form-control')))
            ->add('publicDoc', ChoiceType::class, array('label'=> 'Document type',
                                                                  'choices'=>array('Scholar Homepage document'=>1,
                                                                                   'Exam Homepage document'=>2,
                                                                                   'Private scholar'=>3),                                           
                                                                  'attr' => array('class'=>'form-control')))
            ->add('file', FileType::class, array('label'=> 'Select a document',
                                                 'data_class' => null))
            ->add('Valider', SubmitType::class, array('label'=>'Send',
                                                      'attr'=> array('class'=>'btn btn-success')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArticleBundle\Entity\Document'
        ));
    }

    public function getName()
    {
        return 'document_type_form';
    }
}
