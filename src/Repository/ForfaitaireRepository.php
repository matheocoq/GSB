<?php

namespace App\Repository;

use App\Entity\Forfaitaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Forfaitaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Forfaitaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Forfaitaire[]    findAll()
 * @method Forfaitaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForfaitaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Forfaitaire::class);
    }

    // /**
    //  * @return Forfaitaire[] Returns an array of Forfaitaire objects
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
    public function findOneBySomeField($value): ?Forfaitaire
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findLesForfaitaire($id)
    {
        return $this->createQueryBuilder('FORFAITAIRE')
            ->andWhere('FORFAITAIRE.idFiche = :id')
            ->setParameter('id',$id)
            ->getQuery()
            ->getResult();
        
    }
    public function listProc($id)
{
    $stmt = $this->getEntityManager()
                 ->getConnection()
                 ->prepare('CALL FicheForfait(?)')
                 ;
                 
    $stmt->bindParam(1, $id, \PDO::PARAM_INT|\PDO::PARAM_INPUT_OUTPUT); 
    $stmt->execute();
    $result=$stmt->fetchAll();
    return $result;
}
    
}
