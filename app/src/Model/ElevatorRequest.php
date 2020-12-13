<?php

namespace App\Model;

class ElevatorRequest
{
    /**
     * @var int
     */
    private $building;
    
    /**
     * @var int
     */
    private $floorFrom;

    /**
     * @var int
     */
    private $floorTo;

    /**
     * @var \DateTime|null
     */
    private $time;


    /**
     * Get the value of building
     *
     * @return  int
     */ 
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * Set the value of building
     *
     * @param  int  $building
     *
     * @return  self
     */ 
    public function setBuilding(int $building)
    {
        $this->building = $building;

        return $this;
    }

    /**
     * Get the value of floorFrom
     *
     * @return  int
     */ 
    public function getFloorFrom()
    {
        return $this->floorFrom;
    }

    /**
     * Set the value of floorFrom
     *
     * @param  int  $floorFrom
     *
     * @return  self
     */ 
    public function setFloorFrom(int $floorFrom)
    {
        $this->floorFrom = $floorFrom;

        return $this;
    }

    /**
     * Get the value of floorTo
     *
     * @return  int
     */ 
    public function getFloorTo()
    {
        return $this->floorTo;
    }

    /**
     * Set the value of floorTo
     *
     * @param  int  $floorTo
     *
     * @return  self
     */ 
    public function setFloorTo(int $floorTo)
    {
        $this->floorTo = $floorTo;

        return $this;
    }

    /**
     * Get the value of time
     *
     * @return  \DateTime|null
     */ 
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set the value of time
     *
     * @param  \DateTime|null  $time
     *
     * @return  self
     */ 
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }
}