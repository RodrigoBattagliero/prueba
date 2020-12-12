<?php

namespace App\Entity;

use App\Repository\BuildingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BuildingRepository::class)
 */
class Building
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
     * @ORM\OneToMany(targetEntity=Floor::class, mappedBy="building")
     */
    private $floors;

    /**
     * @ORM\OneToMany(targetEntity=Elevator::class, mappedBy="building")
     */
    private $elevators;

    public function __construct()
    {
        $this->floors = new ArrayCollection();
        $this->elevators = new ArrayCollection();
    }

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

    /**
     * @return Collection|Floor[]
     */
    public function getFloors(): Collection
    {
        return $this->floors;
    }

    public function addFloor(Floor $floor): self
    {
        if (!$this->floors->contains($floor)) {
            $this->floors[] = $floor;
            $floor->setBuilding($this);
        }

        return $this;
    }

    public function removeFloor(Floor $floor): self
    {
        if ($this->floors->removeElement($floor)) {
            // set the owning side to null (unless already changed)
            if ($floor->getBuilding() === $this) {
                $floor->setBuilding(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Elevator[]
     */
    public function getElevators(): Collection
    {
        return $this->elevators;
    }

    public function addElevator(Elevator $elevator): self
    {
        if (!$this->elevators->contains($elevator)) {
            $this->elevators[] = $elevator;
            $elevator->setBuilding($this);
        }

        return $this;
    }

    public function removeElevator(Elevator $elevator): self
    {
        if ($this->elevators->removeElement($elevator)) {
            // set the owning side to null (unless already changed)
            if ($elevator->getBuilding() === $this) {
                $elevator->setBuilding(null);
            }
        }

        return $this;
    }
}
