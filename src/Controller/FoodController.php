<?php

namespace App\Controller;

use App\Entity\Food;
use App\Form\FoodType;
use App\Repository\FoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FoodController extends AbstractController
{
    /**
     * @Route("/foods", name="foods")
     * @param FoodRepository $foodRepository
     * @return Response
     */
    public function index(FoodRepository $foodRepository)
    {
        $foods = $foodRepository->findAll();
        return $this->render('food/index.html.twig', [
            'foods' => $foods
        ]);
    }

    /**
     * @Route("/food/{id}", name="food", defaults={"id" = 0})
     * @param $id
     * @param FoodRepository $foodRepository
     * @param Request $request
     * @return Response
     */
    public function food($id, FoodRepository $foodRepository, Request $request)
    {
        if ($id) {
            $food = $foodRepository->findOneBy(['id' => $id]);
            $page_name = 'Modifier un aliment';
        } else {
            $food = new Food();
            $page_name = 'Création d\'un aliment';
        }

        $form = $this->createForm(FoodType::class, $food);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $food = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($food);
            $entityManager->flush();

            return $this->redirectToRoute('food', ['id' => $food->getId()]);
        }

        return $this->render('food/food.html.twig', [
            'page_name' => $page_name,
            'form' => $form->createView()
        ]);
    }
}
