<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    /**
     * @Route("/recipes", name="recipe_list")
     * @param RecipeRepository $recipeRepository
     * @return Response
     */
    public function list(RecipeRepository $recipeRepository)
    {
        $recipes = $recipeRepository->findAll();
        return $this->render('recipe/recipes.html.twig', [
            'recipes' => $recipes
        ]);
    }

    /**
     * @Route("/recipe/{id}", name="recipe_show", requirements={"id"="\d+"})
     * @param Recipe $recipe
     * @return Response
     */
    public function show(Recipe $recipe)
    {
        return $this->render('recipe/recipe.html.twig', [
            'recipe' => $recipe
        ]);
    }

    /**
     * @Route("/recipe/create", name="recipe_create")
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function create(Request $request)
    {
        $form = $this->createForm(RecipeType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $recipe = $form->getData();

            $datetime = new DateTime();
            $recipe->setDateCreated($datetime);
            $recipe->setDateUpdated($datetime);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recipe);
            $entityManager->flush();

            return $this->redirectToRoute('recipe_show', ['id' => $recipe->getId()]);
        }

        return $this->render('recipe/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/recipe/{id}/edit", name="recipe_edit")
     * @param Recipe $recipe
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function edit(Recipe $recipe, Request $request)
    {
        // Create an ArrayCollection of the current Ingredient objects in the database
        $originalIngredients = new ArrayCollection();
        foreach ($recipe->getIngredients() as $ingredient) {
            $originalIngredients->add($ingredient);
        }

        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Recipe $recipe */
            $recipe = $form->getData();

            $datetime = new DateTime();
            $recipe->setDateUpdated($datetime);

            $entityManager = $this->getDoctrine()->getManager();
            foreach ($originalIngredients as $ingredient) {
                if (!$recipe->getIngredients()->contains($ingredient)) {
                    $ingredient->getRecipe()->removeIngredient($ingredient);
                    $entityManager->remove($ingredient);
                }
            }
            foreach($recipe->getIngredients() as $ingredient) {
                $ingredient->setRecipe($recipe);
            }

            $entityManager->persist($recipe);
            $entityManager->flush();

            return $this->redirectToRoute('recipe_show', ['id' => $recipe->getId()]);
        }

        return $this->render('recipe/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/recipe/{id}/delete", name="recipe_delete")
     * @param Recipe $recipe
     * @return RedirectResponse
     */
    public function delete(Recipe $recipe)
    {
        $entityManager = $this->getDoctrine()->getManager();
        foreach ($recipe->getIngredients() as $ingredient) {
            $ingredient->getRecipe()->removeIngredient($ingredient);
            $entityManager->remove($ingredient);
        }
        $entityManager->remove($recipe);
        $entityManager->flush();

        return $this->redirectToRoute('recipe_list');
    }
}
