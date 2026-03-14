<?php

namespace App\Repository;

use App\Entity\Panier;
use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class PanierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Panier::class);
    }

    public function creerPanier(): Panier
    {
        $panier = $this->findOneBy([]);
        if ($panier=== null) {
            $panier = new Panier();
            $panier->setQuantite(0); 
            $panier->setMontant('0');
            $this->getEntityManager()->persist($panier);
            $this->getEntityManager()->flush();
        }
        return $panier;
    }

    public function ajouterProduit(Panier $panier, Produit $produit): void
    {
        $quantite = $panier->getQuantite(); 
        $montant = $panier->getMontant(); 
        
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select('panier') 
            ->from(Panier::class, 'panier') 
            ->join('panier.id_produit', 'p')  
            ->where('p.id = :produitId') 
            ->setParameter('produitId', $produit->getId());
        $resultat = $query->getQuery()->getResult();

        if (count($resultat) > 0) {
            $quantite++;
        } else {
            $panier->addIdProduit($produit);
            $quantite++;
        }

        $montant= $montant + $produit->getPrix();
        $panier->setQuantite($quantite);
        $panier->setMontant($montant);
        $this->getEntityManager()->persist($panier);
        $this->getEntityManager()->flush();
    }


    public function supprimerProduit(Panier $panier, Produit $produit): void
    {
        $produits = $panier->getIdProduit();
        $produitId = $produit->getId();
        $produitTrouve = false;
        
        foreach ($produits as $p) {
            if ($produitTrouve === false && $p->getId() === $produitId) {
                $produitTrouve = true;
                $panier->removeIdProduit($p);
                
                $montantActuel = $panier->getMontant();
                $quantiteActuelle = $panier->getQuantite();
                
                $nouveauMontant = $montantActuel - $produit->getPrix();
                $nouvelleQuantite = $quantiteActuelle - 1;
                
                $panier->setMontant($nouveauMontant);
                $panier->setQuantite($nouvelleQuantite);
                break;
            }
        }
        
        $this->getEntityManager()->flush();
    }

    public function viderPanier(Panier $panier): void
    {
        $produits = $panier->getIdProduit();
    
        foreach ($produits as $produit) {
            $panier->removeIdProduit($produit);
        }

        $panier->setQuantite(0); 
        $panier->setMontant('0'); 
        $this->getEntityManager()->flush();
    }
    

    
}