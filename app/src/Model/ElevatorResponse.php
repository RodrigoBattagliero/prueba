<?php
namespace App\Model;

use App\Entity\Floor;
use App\Entity\Elevator;

class ElevatorResponse
{
    /**
     * @var Elevator
     */
    private $elevator;
    
    /**
     * @var Floor[]
     */
    private $toOriginRequest;

    /**
     * @var Floor[]
     */
    private $toDestinationRequest;

    /**
     * @var int
     */
    private $countFloor;



    /**
     * Get the value of toOriginRequest
     *
     * @return  Floor[]
     */ 
    public function getToOriginRequest()
    {
        return $this->toOriginRequest;
    }

    /**
     * Set the value of toOriginRequest
     *
     * @param  Floor[]  $toOriginRequest
     *
     * @return  self
     */ 
    public function setToOriginRequest(array $toOriginRequest)
    {
        $this->toOriginRequest = $toOriginRequest;

        return $this;
    }

    /**
     * Get the value of toDestinationRequest
     *
     * @return  Floor[]
     */ 
    public function getToDestinationRequest()
    {
        return $this->toDestinationRequest;
    }

    /**
     * Set the value of toDestinationRequest
     *
     * @param  Floor[]  $toDestinationRequest
     *
     * @return  self
     */ 
    public function setToDestinationRequest(array $toDestinationRequest)
    {
        $this->toDestinationRequest = $toDestinationRequest;

        return $this;
    }

    /**
     * Get the value of countFloor
     *
     * @return  int
     */ 
    public function getCountFloor()
    {
        return $this->countFloor;
    }

    /**
     * Set the value of countFloor
     *
     * @param  int  $countFloor
     *
     * @return  self
     */ 
    public function setCountFloor(int $countFloor)
    {
        $this->countFloor = $countFloor;

        return $this;
    }

    /**
     * Get the value of elevator
     *
     * @return  Elevator
     */ 
    public function getElevator()
    {
        return $this->elevator;
    }

    /**
     * Set the value of elevator
     *
     * @param  Elevator  $elevator
     *
     * @return  self
     */ 
    public function setElevator(Elevator $elevator)
    {
        $this->elevator = $elevator;

        return $this;
    }
}