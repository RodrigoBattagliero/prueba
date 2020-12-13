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
    public function getOrderedFloorByBuildingId(int $buildingId) :?array
    {
        $building = $this->em->getRepository(Building::class)->find($buildingId);

        return $this->getOrderedFloorByBuilding($building);
    }

    /**
     * @param Building $building
     * @param string $criteria
     * @param int|null $fromPosition
     * @param int|null $toPosition
     * 
     * @return Floor[]|null
     */
    public function getOrderedFloorByBuilding(
        Building $building, 
        string $criteria =  Floor::SEARCH_CRITERIA_ASC, 
        ?int $fromPosition = null, 
        ?int $toPosition = null
    ) :?array
    {
        return $this->em->getRepository(Floor::class)->findOrderedFloorByBuildingId(
            $building, 
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