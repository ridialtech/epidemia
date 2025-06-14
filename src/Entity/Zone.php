<?php

namespace App\Entity;

use App\Repository\ZoneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ZoneRepository::class)]
class Zone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 20)]
    private ?string $status = null;

    #[ORM\Column]
    private ?int $nbHabitants = null;

    #[ORM\Column]
    private ?int $nbSymptomatiques = null;

    #[ORM\Column]
    private ?int $nbPositifs = null;

    #[ORM\ManyToOne(inversedBy: 'zones')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Country $country = null;

    /**
     * @var Collection<int, PointSurveillance>
     */
    #[ORM\OneToMany(targetEntity: PointSurveillance::class, mappedBy: 'zone')]
    private Collection $points;

    public function __construct()
    {
        $this->points = new ArrayCollection();
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getNbHabitants(): ?int
    {
        return $this->nbHabitants;
    }

    public function setNbHabitants(int $nbHabitants): static
    {
        $this->nbHabitants = $nbHabitants;

        return $this;
    }

    public function getNbSymptomatiques(): ?int
    {
        return $this->nbSymptomatiques;
    }

    public function setNbSymptomatiques(int $nbSymptomatiques): static
    {
        $this->nbSymptomatiques = $nbSymptomatiques;

        return $this;
    }

    public function getNbPositifs(): ?int
    {
        return $this->nbPositifs;
    }

    public function setNbPositifs(int $nbPositifs): static
    {
        $this->nbPositifs = $nbPositifs;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): static
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection<int, PointSurveillance>
     */
    public function getPoints(): Collection
    {
        return $this->points;
    }

    public function addPoint(PointSurveillance $point): static
    {
        if (!$this->points->contains($point)) {
            $this->points->add($point);
            $point->setZone($this);
        }

        return $this;
    }

    public function removePoint(PointSurveillance $point): static
    {
        if ($this->points->removeElement($point)) {
            // set the owning side to null (unless already changed)
            if ($point->getZone() === $this) {
                $point->setZone(null);
            }
        }

        return $this;
    }
}
