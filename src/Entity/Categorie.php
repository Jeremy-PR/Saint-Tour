<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['lieu:read'])]
    private ?string $name = null;

    /**
     * @var Collection<int, Lieu>
     */
    #[ORM\ManyToMany(targetEntity: Lieu::class, mappedBy: 'categories')]
    private Collection $lieux;

    /**
     * @var Collection<int, Itineraire>
     */
    #[ORM\ManyToMany(targetEntity: Itineraire::class, mappedBy: 'categories')]
    private Collection $itineraires;

    public function __construct()
    {
        $this->lieux = new ArrayCollection();
        $this->itineraires = new ArrayCollection();
    }

   public function __toString(): string
    {
        return $this->name;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Lieu>
     */
    public function getLieux(): Collection
    {
        return $this->lieux;
    }

    public function addLieux(Lieu $lieux): static
    {
        if (!$this->lieux->contains($lieux)) {
            $this->lieux->add($lieux);
            $lieux->addCategory($this);
        }

        return $this;
    }

    public function removeLieux(Lieu $lieux): static
    {
        if ($this->lieux->removeElement($lieux)) {
            $lieux->removeCategory($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Itineraire>
     */
    public function getItineraires(): Collection
    {
        return $this->itineraires;
    }

    public function addItineraire(Itineraire $itineraire): static
    {
        if (!$this->itineraires->contains($itineraire)) {
            $this->itineraires->add($itineraire);
            $itineraire->addCategory($this);
        }

        return $this;
    }

    public function removeItineraire(Itineraire $itineraire): static
    {
        if ($this->itineraires->removeElement($itineraire)) {
            $itineraire->removeCategory($this);
        }

        return $this;
    }

    
}
