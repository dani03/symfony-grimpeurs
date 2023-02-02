<?php

namespace App\Form;

use App\Entity\Jpo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JpoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lieu', TextType::class, [
                "attr" => array(
                    'class' => 'form-control',
                    'placeholder' => 'entrer le lieu',
                ),
                'label' => 'lieu'
            ])
            ->add('title', TextType::class, [ "attr" => array(
                'class' => 'form-control',
                'placeholder' => 'theme de la journée',
            ),
            ])
            ->add('places', IntegerType::class,[
                "attr" => array(
                    'class' => 'form-control',
                    'placeholder' => 'nombre de place',
                ),
                'label' => 'place disponibles'
            ])
            //->add('created_at')
           // ->add('updated_at')
           /* ->add('user')
            ->add('users')*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Jpo::class,
        ]);
    }
}
