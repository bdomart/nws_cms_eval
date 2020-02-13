<?php

namespace App\Controller;

use App\Repository\FoodRepository;
use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param RecipeRepository $recipeRepository
     * @param FoodRepository $foodRepository
     * @return Response
     */
    public function index(RecipeRepository $recipeRepository, FoodRepository $foodRepository)
    {
        $recipes = $recipeRepository->findBy([], ['date_updated' => 'DESC'], 3);
        $foods = $foodRepository->findBy([], ['date_updated' => 'DESC'], 20);
        return $this->render('index.html.twig', [
            'recipes' => $recipes,
            'foods' => $foods
        ]);
    }
}
