<?php

namespace App\Controller;

use App\Entity\Favorite;
use App\Form\FavoriteType;
use App\Repository\FavoriteRepository;
use App\Repository\HomeProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;

#[Route('/favorite')]
class FavoriteController extends AbstractController
{
    #[Route('/', name: 'app_favorite_index', methods: ['GET'])]
    public function index(FavoriteRepository $favoriteRepository): Response
    {
        return $this->render('favorite/index.html.twig', [
            'favorites' => $favoriteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_favorite_new', methods: ['POST'])]
    public function new(Request $request, FavoriteRepository $favoriteRepository, ProductRepository $ProductRepository, UserRepository $userRepository): Response
    {
        $productId = $request->get("productId");
        $userId = $request->get("userId");
        
        $favorite = new Favorite();
        $favorite->setProduct($ProductRepository->find($productId));
        $favorite->setUser($userRepository->find($userId));
        $favoriteRepository->add($favorite, true);
        return $this->redirectToRoute('app_home_product_index', [], Response::HTTP_SEE_OTHER);

    }

    #[Route('/{id}', name: 'app_favorite_show', methods: ['GET'])]
    public function show(Favorite $favorite): Response
    {
        return $this->render('favorite/show.html.twig', [
            'favorite' => $favorite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_favorite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Favorite $favorite, FavoriteRepository $favoriteRepository): Response
    {
        $form = $this->createForm(FavoriteType::class, $favorite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $favoriteRepository->add($favorite, true);

            return $this->redirectToRoute('app_favorite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('favorite/edit.html.twig', [
            'favorite' => $favorite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_favorite_delete', methods: ['POST'])]
    public function delete(Request $request, Favorite $favorite, FavoriteRepository $favoriteRepository): Response
    {
    // if ($this->isCsrfTokenValid('delete'.$favorite->getId(), $request->request->get('_token'))) {
    // }
            $favoriteRepository->remove($favorite, true);
        

        return $this->redirectToRoute('app_home_product_index', [], Response::HTTP_SEE_OTHER);
    }

    // #[Route('/{id}', name: 'app_favorite_delete', methods: ['GET'])]
    // public function delete(Request $request, Favorite $favorite, FavoriteRepository $favoriteRepository): Response
    // {
       
    //         $favoriteRepository->remove($favorite, true);
        

    //     return $this->redirectToRoute('app_favorite_index', [], Response::HTTP_SEE_OTHER);
    // }

}
