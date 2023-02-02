<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Entrer votre email',
                    'required' => 'true'
                ),
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrez votre email pour continuer'
                    ])
                ]
            ])
            ->add('firstname', TextType::class, [
                'attr' => array(
                     'class' => 'form-control',
                    'placeholder' => 'Entrer votre prénom',
                    'required' => 'true'
                ),
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrez votre prénom pour continuer'
                    ])
                ]
            ])
            ->add('lastname', TextType::class, [
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Entrer votre nom',
                    'required' => 'true'
                ),
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrez votre nom pour continuer'
                    ])
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Veuillez acceptez les termes pour continuer.',
                    ]),
                ],
                'label' => 'Acceptez les Termes'
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Entrer votre mot de passe',
                    'required' => 'true'
                ),
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrez un mot de passe pour continuer',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit faire au moins {{ limit }} caractères',
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
