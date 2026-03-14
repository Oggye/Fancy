<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    public function getProduit($value) : array
    {
        $entityManager = $this->getEntityManager();

        $query= $entityManager->createQuery(
            'SELECT p 
            FROM App\Entity\Produit p
            WHERE p.nom LIKE :nom OR p.description LIKE :nom OR p.prix LIKE :nom'
        )->setParameter('nom','%'.$value.'%');

        return $query->getResult();
    }
}
