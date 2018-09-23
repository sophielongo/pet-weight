<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WeightRepository")
 */
class Weight
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"pet_details"})
     */
    private $value;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"pet_details"})
     */
    private $measuring_unit;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"pet_details"})
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pet", inversedBy="weights")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getMeasuringUnit(): ?string
    {
        return $this->measuring_unit;
    }

    public function setMeasuringUnit(string $measuring_unit): self
    {
        $this->measuring_unit = $measuring_unit;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPet(): ?Pet
    {
        return $this->pet;
    }

    public function setPet(?Pet $pet): self
    {
        $this->pet = $pet;

        return $this;
    }
}
