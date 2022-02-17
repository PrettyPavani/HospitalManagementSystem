<?php

namespace App\Form;

use App\Entity\Doctor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AddDoctorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('specialization', ChoiceType::class, [
                'choices' => [
                    'Dentist' => 1,
                    'Genral' => 2,
                    'gynaecologist' => 3,
                ],
                'choice_attr' => [
                    'Dentist' => ['data' => 'Dentist'],
                    'Genral' => ['data' => 'Genral'],
                    'gynaecologist' => ['data' => 'gynaecologist'],

                ],
            ])

            // ->add('specialization',ChoiceType::class, [
            //     'choice_attr' => ChoiceList::attr($this, function (?Doctor $doctor) {
            //         return $doctor ? ['specialization' => $doctor->getSpecialization()] : [];
            //     }),
            // ]))
            ->add('fees')
            ->add('email')
            ->add('password')
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NULL,
            'data_class' => Doctor::class,
        ]);
    }
}
