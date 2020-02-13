<?php

namespace App\Controller;

use App\Entity\Food;
use App\Form\FoodType;
use App\Repository\FoodRepository;
use DateTime;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FoodController extends AbstractController
{
    /**
     * @Route("/foods", name="food_list")
     * @param FoodRepository $foodRepository
     * @return Response
     */
    public function list(FoodRepository $foodRepository)
    {
        $foods = $foodRepository->findAll();
        return $this->render('food/foods.html.twig', [
            'foods' => $foods
        ]);
    }

    /**
     * @param Food $food
     * @param Request $request
     * @return RedirectResponse|Response
     */
    private function save(Food $food, Request $request)
    {
        $form = $this->createForm(FoodType::class, $food);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $recipe = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($food);
            $entityManager->flush();

            return $this->redirectToRoute('food_list');
        }

        return $this->render('food/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/food/create", name="food_create")
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function create(Request $request)
    {
        $food = new Food();
        $datetime = new DateTime();
        $food->setDateCreated($datetime);
        $food->setDateUpdated($datetime);
        return $this->save($food, $request);
    }

    /**
     * @Route("/food/{id}/edit", name="food_edit")
     * @param Food $food
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function edit(Food $food, Request $request)
    {
        $food->setDateUpdated(new DateTime());
        return $this->save($food, $request);
    }

    /**
     * @Route("/food/{id}/delete", name="food_delete")
     * @param Food $food
     * @return RedirectResponse
     */
    public function delete(Food $food)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($food);
        $entityManager->flush();

        return $this->redirectToRoute('food_list');
    }
}
