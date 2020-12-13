<?php

namespace App\Entity;

use App\Repository\ElevatorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ElevatorRepository::class)
 */
class Elevator
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Building::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $building;

    /**
     * @ORM\ManyToOne(targetEntity=Floor::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $currentFloor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getBuilding(): ?Building
    {
        return $this->building;
    }

    public function setBuilding(?Building $building): self
    {
        $this->building = $building;

        return $this;
    }

    public function getCurrentFloor(): ?Floor
    {
        return $this->currentFloor;
    }

    public function setCurrentFloor(?Floor $currentFloor): self
    {
        $this->currentFloor = $currentFloor;

        return $this;
    }
}
