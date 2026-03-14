<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\PanierRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/ajouter/{produitId}', name: 'ajouter')]
    public function ajouterAuPanier( int $produitId, 
        PanierRepository $panierRepository, 
        ProduitRepository $produitRepository, 
        EntityManagerInterface $entityManager
    ): Response {
        $panier = $panierRepository->CreerPanier();
        $produit = $produitRepository->find($produitId);
        $panierRepository->ajouterProduit($panier, $produit);
        $entityManager->flush();

        return $this->redirectToRoute('panier');
    }

    #[Route('/panier', name: 'panier')]
    public function voirPanier(PanierRepository $panierRepository): Response
    {
        $panier = $panierRepository->CreerPanier();

        return $this->render('panier.html.twig', [
            'panier' => $panier->getIdProduit(),
            'montantTotal' => $panier->getMontant(),
            'quantiteTotale' => $panier->getQuantite()
        ]);
    }

    #[Route('/supprimer/{produitId}', name: 'supprimer')]
    public function supprimerProduit(int $produitId,
        PanierRepository $panierRepository,
        ProduitRepository $produitRepository, 
        EntityManagerInterface $entityManager
    ): Response {
        $panier = $panierRepository->CreerPanier();
        $produit = $produitRepository->find($produitId);

        if ($produit) {
            $panierRepository->supprimerProduit($panier, $produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('panier');
    }

    #[Route('/vider', name: 'vider')]
    public function viderPanier(
        PanierRepository $panierRepository, 
        EntityManagerInterface $entityManager
    ): Response {
        $panier = $panierRepository->CreerPanier();
        $panierRepository->viderPanier($panier);
        $entityManager->flush();

        return $this->redirectToRoute('panier');
    }
    
    
}
