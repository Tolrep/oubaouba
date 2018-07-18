<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Recipe;
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
    public function newRecipePart1(Request $request)
    {
        $recipe = new Recipe();
        $form = $this->createForm('AppBundle\Form\RecipeFirstPartType', $recipe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recipe);
            $em->flush();
            $em->refresh($recipe);

            return ($this->redirectToRoute('endRecipe', ['recipe_id' => $recipe->getId()]));
        }

        return $this->render('recipe/newFirstPart.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new/{recipe_id}", name="endRecipe", requirements={"recipe_id"="\d+"})
     * @ParamConverter("recipe", options={"id" = "recipe_id"})
     * @Method({"GET", "POST"})
     */
    public function newRecipePart2(Request $request, Recipe $recipe)
    {
        $form = $this->createForm('AppBundle\Form\RecipeSecondPartType', $recipe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recipe);
            $em->flush();

            return ($this->redirectToRoute('recipeIndex'));
        }

        return $this->render('recipe/newSecondPart.html.twig', [
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