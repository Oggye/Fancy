<?php
namespace App\Controller;

use App\Entity\User;
use App\Entity\Panier;
use App\Form\CommandeType;
use App\Repository\PanierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'commande')]
    public function showCommande(Request $request, 
        PanierRepository $panierRepository, 
        EntityManagerInterface $entityManager
    ): Response{
        $panier = $panierRepository->creerPanier();
        $quantiteTotale = $panier->getQuantite();
        $montantTotal = $panier->getMontant();

        $form = $this->createForm(CommandeType::class);
        $form->handleRequest($request);

        $message = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Commande validée avec succès !');
            return $this->redirectToRoute('commande');
        }

        return $this->render('commande.html.twig', [
            'form' => $form->createView(),
            'quantiteTotale' => $quantiteTotale,
            'montantTotal' => $montantTotal,
        ]);
    }
}
