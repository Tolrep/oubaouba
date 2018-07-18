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

class RecipeSecondPartType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('personNumber', IntegerType::class, [
                'label' => 'Nombre de couverts: ',
                'attr' => ['maxlenght' => 10],
                'constraints' => new NotBlank(['message' => 'Ce champs ne doit pas être vide']),
            ])
            ->add('ingredients', IngredientType::class, ['label' => 'Ingredient:'])
            ->add('ingredientsValue', IngredientValueType::class, ['label' => 'Quantite'])
            ->add('description', TextareaType::class, array('attr' => array('maxlength' => 200, 'placeholder' => 'Décrivez-votre recette en quelques lignes'),
                'label' => 'Description',
                'required' => false))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}