<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use DateTime;
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
     * @param Recipe $recipe
     * @param Request $request
     * @return RedirectResponse|Response
     */
    private function save(Recipe $recipe, Request $request)
    {
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $recipe = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
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
     * @Route("/recipe/create", name="recipe_create")
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function create(Request $request)
    {
        $recipe = new Recipe();
        $datetime = new DateTime();
        $recipe->setDateCreated($datetime);
        $recipe->setDateUpdated($datetime);
        return $this->save($recipe, $request);
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
        $recipe->setDateUpdated(new DateTime());
        return $this->save($recipe, $request);
    }

    /**
     * @Route("/recipe/{id}/delete", name="recipe_delete")
     * @param Recipe $recipe
     * @return RedirectResponse
     */
    public function delete(Recipe $recipe)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($recipe);
        $entityManager->flush();

        return $this->redirectToRoute('recipe_list');
    }
}
