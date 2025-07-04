<?php

namespace App\Entity;

use App\Repository\LieuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LieuRepository::class)]
class Lieu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['lieu:read', 'itineraire:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['lieu:read', 'itineraire:read'])]
    #[Assert\NotBlank(message: "Le nom du lieu est obligatoire.")]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['lieu:read'])]
    #[Assert\NotBlank(message: "La description est obligatoire.")]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Groups(['lieu:read'])]
    #[Assert\NotBlank(message: "L'adresse est obligatoire.")]
    private ?string $adresse = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 6)]
    #[Groups(['lieu:read', 'itineraire:read'])]
    private ?float $latitude = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 6)]
    #[Groups(['lieu:read', 'itineraire:read'])]
    private ?float $longitude = null;

    #[ORM\Column(length: 255)]
    #[Groups(['lieu:read'])]
    private ?string $image = null;

    /**
     * @var Collection<int, Categorie>
     */
    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'lieux')]
    #[ORM\JoinTable(name: 'lieu_categorie')]
    #[Groups(['lieu:read'])]
    private Collection $categories;

    /**
     * @var Collection<int, Itineraire>
     */
    #[ORM\ManyToMany(targetEntity: Itineraire::class, mappedBy: 'lieux')]
    private Collection $itineraires;

 

    public function __construct()
    {
        $this->categories = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): static
    {
        $this->categories->removeElement($category);

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
        }

        return $this;
    }

    public function removeItineraire(Itineraire $itineraire): static
    {
        $this->itineraires->removeElement($itineraire);

        return $this;
    }

    
}
