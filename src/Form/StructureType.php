<?php

namespace App\Form;

use App\Entity\Partner;
use App\Entity\Structure;
use App\Entity\StructurePermission;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StructureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('structure_name')
            ->add('structure_phone')
            ->add('structure_address')
            ->add('structure_postal')
            ->add('structure_active',CheckboxType::class,[
                'required' => false,
                'label_attr' => [
                    'class' => 'checkbox-switch',
                ]
            ])
            ->add('structure_partner', EntityType::class,[
                'class' => Partner::class,
                'choice_label' => 'partner_name',
                'multiple' => false,
                'expanded' => true
            ])
            ->add('structurePermissions', EntityType::class,[
                'class' => StructurePermission::class,
                'choice_label' => 'structure_permission_name',
                'by_reference' => false,
                'multiple' => true,
                'expanded' => true
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Structure::class,
        ]);
    }
}

