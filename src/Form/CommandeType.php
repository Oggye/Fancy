<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', TextType::class, [
                'label' => 'Prénom :',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez votre prénom',
                ],
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom :',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez votre nom',
                ],
            ])
            ->add('numero', NumberType::class, [
                'label' => 'Numéro :',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez votre numéro de téléphone',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider la commande'
            ]);
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
