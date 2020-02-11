<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FoodCompositionRepository")
 */
class FoodComposition
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Food", inversedBy="foodCompositions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $food;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FoodComponent", inversedBy="foodCompositions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $food_component;

    /**
     * @ORM\Column(type="float")
     */
    private $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFood(): ?Food
    {
        return $this->food;
    }

    public function setFood(?Food $food): self
    {
        $this->food = $food;

        return $this;
    }

    public function getFoodComponent(): ?FoodComponent
    {
        return $this->food_component;
    }

    public function setFoodComponent(?FoodComponent $food_component): self
    {
        $this->food_component = $food_component;

        return $this;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
