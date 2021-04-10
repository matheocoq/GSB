<?php

namespace App\Repository;

use App\Entity\FicheFrais;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FicheFrais|null find($id, $lockMode = null, $lockVersion = null)
 * @method FicheFrais|null findOneBy(array $criteria, array $orderBy = null)
 * @method FicheFrais[]    findAll()
 * @method FicheFrais[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FicheFraisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FicheFrais::class);
    }

    // /**
    //  * @return FicheFrais[] Returns an array of FicheFrais objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FicheFrais
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function verifFiche($date,$idUtilisateur)
    {
        return $this->createQueryBuilder('FICHE_FRAIS')
            ->where('FICHE_FRAIS.date BETWEEN :debut AND :fin ')
            ->andWhere('FICHE_FRAIS.identifiant = :id')
            ->setParameter('debut',$date.'-01')
            ->setParameter('fin',$date.'-31')
            ->setParameter('id',$idUtilisateur)
            ->getQuery()
            ->getOneOrNullResult();
        
    }
    public function FicheUtilisateur($idUtilisateur)
    {
        return $this->createQueryBuilder('FICHE_FRAIS')
            ->where('FICHE_FRAIS.identifiant = :id')
            ->setParameter('id',$idUtilisateur)
            ->getQuery()
            ->getResult();
        
    }

    public function FicheUtilisateurDate($idUtilisateur,$date)
    {
        return $this->createQueryBuilder('FICHE_FRAIS')
            ->where('FICHE_FRAIS.date BETWEEN :debut AND :fin ')
            ->andWhere('FICHE_FRAIS.identifiant = :id')
            ->andWhere('FICHE_FRAIS.idEtat = 1')
            ->setParameter('id',$idUtilisateur)
            ->setParameter('debut',$date.'-01-01')
            ->setParameter('fin',$date.'-12-31')
            ->getQuery()
            ->getResult();
        
    }
    
}
