<?php
namespace App\Service;

use App\Entity\Building;
use App\Entity\Floor;
use Doctrine\ORM\EntityManagerInterface;

class FloorService
{
    private $em;

    public function __construct(
        EntityManagerInterface $em
    )
    {
        $this->em = $em;
    }

    /**
     * @param int $buildingId
     * @param string $criteria
     * @param int|null $fromPosition
     * @param int|null $toPosition
     * 
     * @return Floor[]|null
     */
    public function getOrderedFloorByBuildingId(
        int $buildingId, 
        string $criteria, 
        ?int $fromPosition = null, 
        ?int $toPosition = null
    ) :?array
    {
        return $this->em->getRepository(Floor::class)->findOrderedFloorByBuildingId(
            $buildingId, 
            $criteria,
            $fromPosition, 
            $toPosition
        );
    }

    /**
     * @param Building $building
     * 
     * @return Floor
     */
    public function getFirstFloor(Building $building) :Floor
    {
        $floor = $this->em->getRepository(Floor::class)->findFirstFloor($building);
        if ($floor === null) {
            throw new \Exception("First floor not found.");
        }

        return $floor;
    }
}