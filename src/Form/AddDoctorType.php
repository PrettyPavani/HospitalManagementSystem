<?php

namespace App\Form;

use App\Entity\Doctor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class AddDoctorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'bg-transparent block mt-10 mx-auto border-b-2 w-1/5 h-20 text-2xl outline-none',
                    'placeholder' => 'Name'
                ],
            ])
            ->add('specialization', ChoiceType::class, 
            [
                'choices' => [
                    'Dentist' => 1,
                    'Genral' => 2,
                    'gynaecologist' => 3,
                ],               
                'attr' => [
                    'class' => 'bg-transparent block mt-10 mx-auto border-b-2 w-1/5 h-20 text-2xl outline-none',
                    'placeholder' => 'Specialization'
                ],
            ])
            ->add('fees',TextType::class,[
                'attr' => [
                   'class' => 'bg-transparent block mt-10 mx-auto border-b-2 w-1/5 h-20 text-2xl outline-none',
                   'placeholder' => 'Consultancy Fees'
               ]])
            ->add('email', TextType::class,[
             'attr' => [
                'class' => 'bg-transparent block mt-10 mx-auto border-b-2 w-1/5 h-20 text-2xl outline-none',
                'placeholder' => 'Email'
            ]])
            ->add('password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',                     
                    'class' => 'bg-transparent block mt-10 mx-auto border-b-2 w-1/5 h-20 text-2xl outline-none',
                    'placeholder' => 'Password'
                ]] )
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NULL,
            // 'data_class' => Doctor::class,
        ]);
    }
}
