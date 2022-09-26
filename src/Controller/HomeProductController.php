<?php

namespace App\Controller;

use App\Entity\Favorite;
use App\Form\FavoriteType;
use App\Entity\HomeProduct;
use App\Form\HomeProductType;
use App\Repository\HomeProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/home_product')]
class HomeProductController extends AbstractController
{

    #[Route('/', name: 'app_home_product_index', methods: ['GET'])]
    public function index(HomeProductRepository $homeProductRepository): Response
    {
        // https://symfony.com/doc/current/forms.html
        // Create a new object Favorite
        $favorite = new Favorite();

        // Creates and returns a Form instance from the type of the form. 
        $form = $this->createForm(FavoriteType::class, $favorite);

        // Get logged user's object
        $user = (object) $this->getUser();

        // Get home's object of the logged user
        $home_user = $user->getHome();

        return $this->render('home_product/index.html.twig', [
            'home_products' => $homeProductRepository->findBy(['home'=> $home_user]),

            // In versions prior to Symfony 5.3, controllers used the method $this->render('...', ['form' => $form->createView()]) to render the form. The renderForm() method abstracts this logic and it also sets the 422 HTTP status code in the response automatically when the submitted form is not valid.
            'form' => $form->createView(),
        ]);
    }

    #[Route('/new', name: 'app_home_product_new', methods: ['GET', 'POST'])]
    public function new(Request $request, HomeProductRepository $homeProductRepository): Response
    {
        $homeProduct = new HomeProduct();
        $form = $this->createForm(HomeProductType::class, $homeProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $homeProductRepository->add($homeProduct, true);

            return $this->redirectToRoute('app_home_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('home_product/new.html.twig', [
            'home_product' => $homeProduct,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_home_product_show', methods: ['GET'])]
    public function show(HomeProduct $homeProduct): Response
    {
        return $this->render('home_product/show.html.twig', [
            'home_product' => $homeProduct,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_home_product_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, HomeProduct $homeProduct, HomeProductRepository $homeProductRepository): Response
    {
        $form = $this->createForm(HomeProductType::class, $homeProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $homeProductRepository->add($homeProduct, true);

            return $this->redirectToRoute('app_home_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('home_product/edit.html.twig', [
            'home_product' => $homeProduct,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_home_product_delete', methods: ['POST'])]
    public function delete(Request $request, HomeProduct $homeProduct, HomeProductRepository $homeProductRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$homeProduct->getId(), $request->request->get('_token'))) {
            $homeProductRepository->remove($homeProduct, true);
        }

        return $this->redirectToRoute('app_home_product_index', [], Response::HTTP_SEE_OTHER);
    }
}
