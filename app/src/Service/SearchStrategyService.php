<?php

namespace App\Service;

use App\Entity\Floor;
use App\Entity\Elevator;

class SearchStrategyService
{

    /**
     * @var Floor[]|null $buildingFloor
     * @var Elevator[]|null $elevators
     * @var Floor $fromFloor
     */
    public function applySearchStrategy(array $buildingFloor, array $elevators, Floor $fromFloor) :Elevator
    {
        $intial = 0;
        $final = count($buildingFloor) - 1;
        $baseIndex = 0;

        foreach ($buildingFloor as $floor) {
            if ($floor->getId() == $fromFloor->getId()) {
                $baseIndex = \key($buildingFloor);
            }
        }

        for ($i = 0; $i <= $final; $i++) {
            $forwardElement = $i + $baseIndex;

            if ($forwardElement <= $final) {
                $selectedElevator = $this->findElevatorInFloor($elevators, $buildingFloor[$forwardElement]);
                if ($selectedElevator) {
                    return $selectedElevator;
                }
            }

            $prevElement = $baseIndex - $i;
            if ($prevElement >= $intial) {
                $selectedElevator = $this->findElevatorInFloor($elevators, $buildingFloor[$prevElement]);
                if ($selectedElevator) {
                    return $selectedElevator;
                }
            }
        }

        throw new \Exception("Elevator not found.");
    }

    /**
     * @param array $elevators
     * @param Floor $floor
     * 
     * @return Elevator|null
     */
    private function findElevatorInFloor(array $elevators, Floor $floor) :?Elevator
    {
        foreach ($elevators as $elevator) {

            if ($elevator->getCurrentFloor() && 
                $elevator->getCurrentFloor()->getId() == $floor->getId()
            ) {
                return $elevator;
            }
        }

        return null;
    }

}