<?php

namespace App\Repository;

use App\Entity\Floor;
use App\Entity\Building;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Floor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Floor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Floor[]    findAll()
 * @method Floor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FloorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Floor::class);
    }

    /**
     * @param Building $building
     * @param string $criteria
     * @param int|null $fromPosition
     * @param int|null $toPosition
     * 
     * @return Floor[]|null
     */
    public function findOrderedFloorByBuildingId(
        Building $building, 
        string $criteria,
        ?int $fromPosition, 
        ?int $toPosition
    ) :?array
    {
        $qb = $this->createQueryBuilder('f')
            ->where('f.building = :building')
            ->setParameter('building', $building)
            ->orderBy('f.position', $criteria)    
        ;

        if ($fromPosition) {
            $qb->andWhere('f.position >= :fromPosition')
                ->setParameter('fromPosition', $fromPosition)
            ;
        }

        if ($toPosition) {
            $qb->andWhere('f.position <= :toPosition')
                ->setParameter('toPosition', $toPosition)
            ;
        }

        return $qb->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param Building $building
     * 
     * @return Floor|null
     */
    public function findFirstFloor(Building $building) :?Floor
    {
        return $this->createQueryBuilder('f')
            ->where('f.building = :building')
            ->setParameter('building', $building)
            ->orderBy('f.position', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
