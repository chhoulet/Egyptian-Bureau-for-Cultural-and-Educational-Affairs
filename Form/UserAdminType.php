<?php

namespace ArticleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use UserBundle\Repository\UserRepository;
use UserBundle\Entity\User;

class UserAdminType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', EntityType::class, array('label'=>'Select the user to attribute a Role ',
                                                       'attr' => array('class'=>'form-control'),
                                                       'class'=>'UserBundle\Entity\User',
                                                       'query_builder'=> function (UserRepository $er)
                                                        {
                                                          //Tapez dans table Boursier !!!
                                                            return $er->createQueryBuilder('u')                                                          
                                                                      ->orderBy('u.username', 'ASC');
                                                        },                                                   
                                                       'choice_label' => 'username'))
            ->add('role', ChoiceType::class, array('label'=>'Select wich Role you want attribute',
                                                   'choices'=> array('Administrator'=>1,
                                                                     'Editor'       =>2,
                                                                     'Management'   =>3),
                                                   'attr' => array('class'=>'form-control')))
            ->add('Submit', SubmitType::class, array('attr'=>array('class'=>'btn btn-info')))            
            ->add('unSubscribe', SubmitType::class, array('label' => 'Retreat of the Rights',
                                                          'attr'=> array('class'=>'btn btn-warning')))
        ;
    }

}
 