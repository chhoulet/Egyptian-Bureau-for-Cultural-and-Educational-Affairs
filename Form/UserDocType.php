<?php

namespace ArticleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use ArticleBundle\Repository\DocumentRepository;
use UserBundle\Repository\UserRepository;

class UserDocType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', EntityType::class, array('label'=> 'Select the scholar',
                                                       'class'=>'UserBundle\Entity\User',
                                                       'choice_label'=>'username',
                                                       'empty_data'=>null,
                                                       /*'query_builder'=> function (UserRepository $er)
                                                        {
                                                            return $er->createQueryBuilder('u')
                                                                      ->where("u.roles = ('ROLE_USER') ")
                                                                      /*->andWhere("u.roles != ('a:1:{i:0;s:16:ROLE_ADMIN;}') "))
                                                                      ->orderBy('u.username', 'ASC');
                                                        },*/
                                                       'attr' => array('class'=>'form-control')))
            ->add('name', TextType::class, array('label'=> 'Document Name',
                                                 'attr' => array('class'=>'form-control')))
            ->add('description', TextType::class, array('label'=> 'Description',
                                                        'attr' => array('class'=>'form-control')))            
            ->add('file', FileType::class, array('label'=> 'Select a document',
                                                 'data_class' => null))
            ->add('Valider', SubmitType::class, array('label'=>'Send',
                                                      'attr'=> array('class'=>'btn btn-success')))          
        ;
    }    
        
}
