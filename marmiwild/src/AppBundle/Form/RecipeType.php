<?php
namespace AppBundle\Form;

use AppBundle\Entity\Recipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
                'label' => 'Nom de la recette',
                'attr' => ['maxlenght' => 45],
                'constraints' => new NotBlank(['message' => 'Ce champs ne doit pas être vide']),
            ])
            ->add('description', TextareaType::class, array('attr' => array('maxlength' => 200, 'placeholder' => 'Décrivez-votre recette en quelques lignes'),
                'label' => 'Description',
                'required' => false))
            ->add('personNumber', IntegerType::class, [
                'label' => 'Nombre de couverts',
                'constraints' => new NotBlank(['message' => 'Ce champs ne doit pas être vide']),
            ])
            ->add('timeToMake', IntegerType::class, [
                'label' => 'Temps de preparation (min)',
                'constraints' => new NotBlank(['message' => 'Ce champs ne doit pas être vide']),
            ])
            ->add('ingredients', IngredientType::class, [
                'label' => false
            ])
            ->add('ingredientsValue', IngredientValueType::class, [
            ])
            ->add('instruction', TextareaType::class, [
                'label' => 'Instruction de preparation',
                'attr' => ['maxlenght' => 250, 'col' => 10, 'rows' => 10],
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}