<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecipeController extends AbstractController
{
/**
 * This controller display all Recipe
 *
 * @param RecipeRepository $repository
 * @param PaginatorInterface $paginator
 * @param Request $request
 * @return Response
 */
    #[Route('/recette', name: 'recipe.index',methods:['GET'])]
    public function index(RecipeRepository $repository,
    PaginatorInterface $paginator,
    Request $request
    ): Response{
 
        $recipes = $paginator->paginate(
            $repository->findAll() ,
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        return $this->render('pages/recipe/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }

    #[Route('/recette/creation', name: 'recipe.new', methods: ['GET', 'POST'])]
    public function new():response{ 
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);

        return $this->render('pages/recipe/new.html.twig', [
            'form' => $form->createView()
        ]);

    }
}
