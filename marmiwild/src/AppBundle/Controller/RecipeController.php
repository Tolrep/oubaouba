<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Recipe;
use AppBundle\Repository\RecipeRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
        $form = $this->createForm('AppBundle\Form\RecipeType', $recipe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recipe);
            $em->flush();

            return ($this->redirectToRoute('recipeIndex'));
        }
        return 1;
    }

    /**
     * @Route("/", name="recipeIndex")
     * @Method({"GET", "POST"})
     */
    public function index(RecipeRepository $recipeRepository)
    {
        $recipes = $recipeRepository->findAll();
        return $this->render('recipe/index.html.twig', $recipes);
    }

}