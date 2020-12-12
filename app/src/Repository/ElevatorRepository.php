<?php

namespace App\Repository;

use App\Entity\Elevator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Elevator|null find($id, $lockMode = null, $lockVersion = null)
 * @method Elevator|null findOneBy(array $criteria, array $orderBy = null)
 * @method Elevator[]    findAll()
 * @method Elevator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElevatorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Elevator::class);
    }

    // /**
    //  * @return Elevator[] Returns an array of Elevator objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Elevator
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
