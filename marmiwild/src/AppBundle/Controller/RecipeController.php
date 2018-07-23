<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ingredient;
use AppBundle\Entity\IngredientValue;
use AppBundle\Entity\Recipe;
use AppBundle\Form\RecipeType;
use AppBundle\Repository\RecipeRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Recipe controller
 *
 * @Route("/recipe")
 */
class RecipeController extends Controller
{
    /**
     * @Route("/new", name="recipeNew")
     * @Method({"GET", "POST"})
     */
    public function newRecipe(Request $request)
    {
        $recipe = new Recipe();
        $recipe->setIngredients([
            new Ingredient(),
        ]);
        $recipe->setIngredientsValue([
            new IngredientValue(),
        ]);
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recipe);
            $em->flush();
            $em->refresh($recipe);
            $this->addFlash('success', 'OK');

            return ($this->redirectToRoute('endRecipe', ['recipe_id' => $recipe->getId()]));
        }

        return $this->render('recipe/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/", name="recipeIndex")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $recipes = $em->getRepository('AppBundle:Recipe')->findAll();

        return $this->render('recipe/index.html.twig', array(
            'recipes' => $recipes,
        ));
    }

}