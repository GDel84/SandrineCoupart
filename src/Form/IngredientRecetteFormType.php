<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\IngredientRecette;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IngredientRecetteFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Ingredient', EntityType::class, [
                // looks for choices from this entity
                'class' => Ingredient::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'Libeller',
            
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,

            ])
            ->add('quantite')
            ->add('Unite')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => IngredientRecette::class,
        ]);
    }
}
