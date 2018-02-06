<?php

namespace App\Repository;

use App\Entity\Evenement;
use App\Entity\Categorie;
use App\Entity\Sport;
use App\Entity\Niveau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class EvenementRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Evenement::class);
    }

public function findEvenement($niveau, $sport, $categorie, $ville, $dateEvenement)
    {
        $qb = $this->createQueryBuilder('e');

        if($niveau != null)
        {
            $qb ->andWhere('e.niveau = :niveau')
                ->setParameter('niveau', $niveau);
        }

        if($sport != null)
        {
            $qb ->andWhere('e.sport = :sport')
                ->setParameter('sport', $sport);
        }
        if($categorie != null)
        {
            $qb ->andWhere('e.categorie = :categorie')
                ->setParameter('categorie', $categorie);
        }
        if($ville != null)
        {
            $qb ->andWhere('e.ville = :ville')
                ->setParameter('ville', $ville);
        }
        if($dateEvenement != null)
        {
            $qb ->andWhere('e.dateEvenement like :dateEvenement')
                ->setParameter('dateEvenement', '%'.$dateEvenement.'%');
        }

        $qb->andWhere('e.statut = false')
            ->orderBy('e.dateEvenement', 'ASC')
            ->getQuery();

        return $qb->getQuery()
                  ->getResult();
    }

public function findEvenementAccueil($sport, $ville)
    {
        $qb = $this->createQueryBuilder('e');

        if($sport != null)
        {
            $qb ->andWhere('e.sport = :sport')
                ->setParameter('sport', $sport);
        }
        if($ville != null)
        {
            $qb ->andWhere('e.ville = :ville')
                ->setParameter('ville', $ville);
        }

        $qb->andWhere('e.statut = false')
            ->orderBy('e.dateEvenement', 'ASC')
            ->getQuery();

        return $qb->getQuery()
                  ->getResult()
                ;
    }
}
