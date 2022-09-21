<?php

namespace App\Controller;

use App\Entity\HomeProduct;
use App\Form\HomeProductType;
use App\Repository\HomeProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/home_product')]
class HomeProductController extends AbstractController
{
    #[Route('/', name: 'app_home_product_index', methods: ['GET'])]
    public function index(HomeProductRepository $homeProductRepository): Response
    {
        return $this->render('home_product/index.html.twig', [
            'home_products' => $homeProductRepository->findAll(),
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
