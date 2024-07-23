<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Form\ProduitsType;
use App\Repository\CategorieRepository;
use App\Repository\ProduitsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitsController extends AbstractController
{
    #[Route('/produits', name: 'app_produits')]
    public function index(): Response
    {
        return $this->render('produits/index.html.twig', [
            'controller_name' => 'ProduitsController',
        ]);
    }

    #[Route('/addproduct', name: 'add_produits')]
    public function add_product (ManagerRegistry $manager,Request $req){
        $em = $manager->getManager();
        $produit = new Produits();
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($req);
        if ($form->isSubmitted()) {
            $produit->setJaime(0);
            $em->persist($produit);
            $em->flush();
        }
        return $this->renderForm('produits/addProduit.html.twig', ['form' => $form]);
    }

    #[Route('/listproduct', name: 'liste_produits')]
    public function list_product (ProduitsRepository $repo)
    {
        return $this->render('produits/listproduits.html.twig',['list'=>$repo->findAll()]);
    }


    #[Route('/like/{id}', name: 'like')]
    public function increment_like (ProduitsRepository $repo ,$id,Request $req,ManagerRegistry $manager)
    {
        $em = $manager->getManager();
        $produit = $repo->find($id);
        $nbjaime =$produit->getJaime()+1;
        $produit->setJaime($nbjaime);
        $em->persist($produit);
        $em->flush();
        return $this->redirectToRoute("liste_produits");

    }

    
}
