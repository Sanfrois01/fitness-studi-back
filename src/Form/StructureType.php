<?php

namespace App\Form;

use App\Entity\Partner;
use App\Entity\Structure;
use App\Entity\StructurePermission;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StructureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('structure_name', TextType::class,[
                "label" => "Nom de la structure",
                "required" => true,
                "sanitize_html" => true 

            ])
            ->add('structure_phone', NumberType::class,[
                'html5' => true,
                "label" => "Telephone de la structure",
                "required" => true
            ])
            ->add('structure_address',TextType::class,[
                "label" => "Adresse de la structure",
                "required" => true,
                "sanitize_html" => true 
                ])
            ->add('structure_postal', NumberType::class,[
                "label" => "Numero postal",
                "required" => true,
                "html5" => true
                ])
            ->add('structure_active',CheckboxType::class,[
                "label" => "Structure active",
                'required' => false,
                'label_attr' => [
                    'class' => 'checkbox-switch',
                ]
            ])
            ->add('structure_partner', EntityType::class,[
                "label" => "Structure lié au partenaire",
                'class' => Partner::class,
                'choice_label' => 'partner_name',
                'multiple' => false,
                'expanded' => true
            ])
            ->add('structurePermissions', EntityType::class,[
                "label" => "Permission de la structure",
                'class' => StructurePermission::class,
                'choice_label' => 'structure_permission_name',
                'by_reference' => false,
                'multiple' => true,
                'expanded' => true
            ])
            ->add('submit', SubmitType::class,[
                "label" => "Envoyer"
            ])        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Structure::class,
        ]);
    }
}

