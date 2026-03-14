<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheController extends AbstractController
{
    #[Route('/recherche', name: 'recherche')]
    public function recherche(Request $request, ProduitRepository $produitRepository): Response
    {   
        $query = $request->get('recherche'); 
    
        $produits = $produitRepository->getProduit($query);
    
        return $this->render('recherche.html.twig', [
            'produits' => $produits,
        ]);
    }
}
