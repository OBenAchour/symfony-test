<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(): Response
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }

    #[Route('/display', name: 'display')]

    public function display_product_cat_greaterzero(CategorieRepository $repo)
    {
        $list = $repo->findCategoriesWithProductsGreaterThanZero();
        return $this->render('categorie/display.html.twig',['listdisplay'=>$list]);
    }

}
