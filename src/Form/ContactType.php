<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Nom*',
                    'value' => ''
                ],
                'required' => true
            ])
            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Prénom*',
                    'value' => ''
                ],
                'required' => true
            ])
            ->add('phone', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Téléphone',
                    'value' => ''
                ],
                'required' => false
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Email*',
                    'value' => ''
                ],
                'required' => true
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Message*',
                    'value' => ''
                ],
                'required' => true
            ]);
    }
}
