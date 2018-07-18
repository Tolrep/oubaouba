<?php
namespace AppBundle\Form;

use AppBundle\Entity\IngredientValue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class IngredientValueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('value', IntegerType::class, [
                'label' => 'Quantite',
                'attr' => ['maxlenght' => 10],
                'constraints' => new NotBlank(['message' => 'Ce champs ne doit pas être vide']),
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Centilitre' => 0,
                    'Gramme' => 1,
                    'Cuillere' => 2,
                    'Pincee' => 3,
                    'Piece' => 4,
                ],'label' => 'Unite']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IngredientValue::class,
        ]);
    }
}
