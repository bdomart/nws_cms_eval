<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FoodComponentRepository")
 */
class FoodComponent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $measure;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FoodComposition", mappedBy="food_component")
     */
    private $foodCompositions;

    public function __construct()
    {
        $this->foodCompositions = new ArrayCollection();
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

    public function getMeasure(): ?string
    {
        return $this->measure;
    }

    public function setMeasure(string $measure): self
    {
        $this->measure = $measure;

        return $this;
    }

    /**
     * @return Collection|FoodComposition[]
     */
    public function getFoodCompositions(): Collection
    {
        return $this->foodCompositions;
    }

    public function addFoodComposition(FoodComposition $foodComposition): self
    {
        if (!$this->foodCompositions->contains($foodComposition)) {
            $this->foodCompositions[] = $foodComposition;
            $foodComposition->setFoodComponent($this);
        }

        return $this;
    }

    public function removeFoodComposition(FoodComposition $foodComposition): self
    {
        if ($this->foodCompositions->contains($foodComposition)) {
            $this->foodCompositions->removeElement($foodComposition);
            // set the owning side to null (unless already changed)
            if ($foodComposition->getFoodComponent() === $this) {
                $foodComposition->setFoodComponent(null);
            }
        }

        return $this;
    }
}
