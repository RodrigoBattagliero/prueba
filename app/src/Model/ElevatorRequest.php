<?php

namespace App\Model;

class ElevatorRequest
{
    /**
     * @var int
     */
    private $floorFrom;

    /**
     * @var int
     */
    private $floorTo;

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
}