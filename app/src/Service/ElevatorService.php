<?php

namespace App\Service;

use App\Entity\Floor;
use App\Entity\Building;
use App\Entity\Elevator;
use App\Service\FloorService;
use App\Model\ElevatorRequest;
use App\Model\ElevatorResponse;
use Doctrine\ORM\Query\Expr\From;
use Doctrine\ORM\EntityManagerInterface;

class ElevatorService 
{

    CONST CRITERIA_ASC = 'ASC';
    CONST CRITERIA_DESC = 'DESC';

    private $em;
    private $floorService;
    private $searchStrategyService;

    public function __construct(
        EntityManagerInterface $em,
        FloorService $floorService,
        SearchStrategyService $searchStrategyService
    )
    {
        $this->em = $em;
        $this->floorService = $floorService;
        $this->searchStrategyService = $searchStrategyService;
    }

    /**
     * Devuelve los ascensores filtrados por building.
     * 
     * @return Elevator[]|null
     */
    public function getAllElevator() :?array
    {
        $buildingId = 3;
        $building = $this->em->getRepository(Building::class)->find($buildingId);
        $elevators = $this->em->getRepository(Elevator::class)->findBy(['building' => $building]);
        
        return $elevators;
    }

    /**
     * @param ElevatorRequest $model
     * 
     * @return ElevatorResponse
     */
    public function requestElevator(ElevatorRequest $model) :?ElevatorResponse
    {
        /** @var Floor[]|null */
        $buildingFloor = $this->floorService->getOrderedFloorByBuildingId($model->getBuilding(), self::CRITERIA_ASC);
        $elevators = $this->em->getRepository(Elevator::class)->findBy(['building' => $model->getBuilding()]);
        $fromFloor = $this->em->getRepository(Floor::class)->find($model->getFloorFrom());
        $toFloor = $this->em->getRepository(Floor::class)->find($model->getFloorTo());

        $this->initElevator($model->getBuilding(), $elevators);
        $closestElevator = $this->searchStrategyService->applySearchStrategy($buildingFloor, $elevators, $fromFloor);
        
        $toOrigin = $this->getPath($fromFloor, $closestElevator);
        $closestElevator->setCurrentFloor($fromFloor);
        $toDestination = $this->getPath($toFloor, $closestElevator);
        $closestElevator->setCurrentFloor($toFloor);
        $modelResponse = $this->createModelResponse($toOrigin, $toDestination, $closestElevator);
        $this->em->flush();

        return $modelResponse;
    }

    /**
     * @var Floor[] $toOrigin
     * @var Floor[] $toDestination
     * @var Elevator $elevator
     * 
     * @return ElevatorResponse
     */
    public function createModelResponse(array $toOrigin, array $toDestination, Elevator $elevator) :ElevatorResponse
    {
        $responseModel = new ElevatorResponse();
        $responseModel->setToOriginRequest($toOrigin);
        $responseModel->setToDestinationRequest($toDestination);
        $responseModel->setElevator($elevator);

        // Se resta uno porque el origen se repite en ambos array.
        $countFloor = \count($toOrigin) + \count($toDestination) - 1;
        $responseModel->setCountFloor($countFloor);

        return $responseModel;
    }

    /**
     * @var Floor $floor
     * @var Elevator $elevator
     */
    public function getPath(Floor $floor, Elevator $elevator)
    {
        if ($elevator->getCurrentFloor()->getPosition() > $floor->getPosition()) {
            $criteria = self::CRITERIA_DESC;
            $fromPosition = $floor->getPosition();
            $toPosition = $elevator->getCurrentFloor()->getPosition();
        } else {
            $criteria = self::CRITERIA_ASC;
            $fromPosition = $elevator->getCurrentFloor()->getPosition();
            $toPosition = $floor->getPosition();
        }

        $orderedFloor = $this->floorService->getOrderedFloorByBuildingId(
            $floor->getBuilding()->getId(), 
            $criteria, 
            $fromPosition, 
            $toPosition
        );

        return $orderedFloor;
    }

    /**
     * @param Elevator[] $elevators
     * @param int $buildingId
     * 
     * @return void
     */
    private function initElevator(int $buildingId, array $elevators) :void
    {
        $building = $this->em->getRepository(Building::class)->find($buildingId);
        $fisrtFloor = $this->floorService->getFirstFloor($building);

        foreach ($elevators as $elevator) {
            if ($elevator->getCurrentFloor() === null) {
                $elevator->setCurrentFloor($fisrtFloor);
            }
        }
        $this->em->flush();
    }
}