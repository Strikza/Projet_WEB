<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class,
                ['label' => 'Peudonyme : '])
            ->add('password',TextType::class,
                ['label' => 'Mot de passe : '])
            ->add('name',TextType::class,
                ['label' => 'Nom : '])
            ->add('firstname',TextType::class,
                ['label' => 'Prénom : '])
            ->add('birth', null,
                ['label' => 'Date de naissance : ',
                'widget' => 'choice',
                'years' => range(date('Y')-100, date('Y')+5)] )
            ->add('isadmin', CheckboxType::class,
            ['label' => 'Admin : '])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
