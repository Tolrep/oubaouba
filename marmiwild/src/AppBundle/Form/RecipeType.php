<?php
namespace AppBundle\Form;

use AppBundle\Entity\Recipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class RecipeType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la recette: ',
                'attr' => ['maxlenght' => 45],
                'constraints' => new NotBlank(['message' => 'Ce champs ne doit pas être vide']),
            ])
            ->add('timeToMake', IntegerType::class, [
                'label' => 'Temps de préparation: ',
                'attr' => ['maxlenght' => 10],
                'constraints' => new NotBlank(['message' => 'Ce champs ne doit pas être vide'])
            ])
            ->add('personNumber', IntegerType::class, [
                'label' => 'Pour combien de personne: ',
                'attr' => ['maxlenght' => 10],
                'constraints' => new NotBlank(['message' => 'Ce champs ne doit pas être vide'])
            ])
            ->add('ingredient', IngredientType::class, [
                'label' => 'Ajouter vaux ingrédients: ',
                'constraints' => new NotBlank(['message' => 'Ce champs ne doit pas être vide'])
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}