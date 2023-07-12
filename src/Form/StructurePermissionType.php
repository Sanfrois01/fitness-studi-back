<?php

namespace App\Form;

use App\Entity\StructurePermission;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class StructurePermissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('structure_permission_name' ,TextType::class,[
                "label" => "Nom de la permission",
                "required" => true,
                "sanitize_html" => true 
                
            ])
            ->add('structure_permission_active' ,CheckboxType::class,[
                "label" => "Permission de la structure active",
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
            'data_class' => StructurePermission::class,
        ]);
    }
}
