<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PetRepository")
 */
class Pet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"pet_details"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"pet_details"})
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"pet_details"})
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=7, nullable=true)
     * @Groups({"pet_details"})
     */
    private $gender;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="pets")
     * @Groups({"pet_details"})
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Weight", mappedBy="pet", orphanRemoval=true)
     * @Groups({"pet_details"})
     */
    private $weights;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->weights = new ArrayCollection();
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

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addPet($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removePet($this);
        }

        return $this;
    }

    /**
     * @return Collection|Weight[]
     */
    public function getWeights(): Collection
    {
        return $this->weights;
    }

    public function addWeight(Weight $weight): self
    {
        if (!$this->weights->contains($weight)) {
            $this->weights[] = $weight;
            $weight->setPet($this);
        }

        return $this;
    }

    public function removeWeight(Weight $weight): self
    {
        if ($this->weights->contains($weight)) {
            $this->weights->removeElement($weight);
            // set the owning side to null (unless already changed)
            if ($weight->getPet() === $this) {
                $weight->setPet(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
