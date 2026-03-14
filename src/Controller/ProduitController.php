<?php

namespace App\Controller;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function accueil(EntityManagerInterface $entityManager): Response
    {
        $produit = $entityManager->getRepository(Produit::class)->findAll();

        return $this->render('accueil.html.twig', ['produit' => $produit]);
    }

    #[Route('/produit/{id}', name: 'produit')]
    public function produit(EntityManagerInterface $entityManager, int $id): Response
    {
        $produit = $entityManager->getRepository(Produit::class)->find($id);

        return $this->render('produit.html.twig', ['produit' => $produit]);
    }

    #[Route('/produit/{id}/image', name: 'produit_image')]
    public function afficherImage(EntityManagerInterface $entityManager, int $id): Response
    {
        $produit = $entityManager->getRepository(Produit::class)->find($id);

        $imageData = $produit->getImage();

        if (is_resource($imageData)) {
            $imageData = stream_get_contents($imageData);
        }

        $response = new Response($imageData);

        $response->headers->set('Content-Type', 'image/jpeg');

        return $response;
    }
    
}
