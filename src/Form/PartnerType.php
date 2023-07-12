<?php

namespace App\Form;

use App\Entity\Partner;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('partner_name', TextType::class, [
                "label" => "Nom du Partenaire",
                "required" => true,
                "sanitize_html" => true 
            ])
            ->add('partner_phone', NumberType::class,[
                "label" => "Telephone du partenaire",
                "required" => true
            ])
            ->add('partner_active' , CheckboxType::class,[
                "label" => "Partenaire Actif",
                'required' => false,
                'label_attr' => [
                    'class' => 'checkbox-switch',
                
                ]
            ])

            ->add('submit', SubmitType::class,[
                "label" => "Envoyer"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Partner::class,
        ]);
    }
}
