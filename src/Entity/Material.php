<?php

namespace App\Entity;

use App\Repository\MaterialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterialRepository::class)]
class Material
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $cost = null;

    #[ORM\ManyToOne(inversedBy: 'materials')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MaterialType $material_type = null;

    #[ORM\ManyToMany(targetEntity: Supplier::class, inversedBy: 'materials')]
    private Collection $supplier;

    #[ORM\OneToMany(mappedBy: 'material', targetEntity: EnvirometalMetric::class)]
    private Collection $material_enviromental_metric;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->supplier = new ArrayCollection();
        $this->material_enviromental_metric = new ArrayCollection();
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

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(float $cost): static
    {
        $this->cost = $cost;

        return $this;
    }

    public function getMaterialType(): ?MaterialType
    {
        return $this->material_type;
    }

    public function setMaterialType(?MaterialType $material_type): static
    {
        $this->material_type = $material_type;

        return $this;
    }

    /**
     * @return Collection<int, Supplier>
     */
    public function getSupplier(): Collection
    {
        return $this->supplier;
    }

    public function addSupplier(Supplier $supplier): static
    {
        if (!$this->supplier->contains($supplier)) {
            $this->supplier->add($supplier);
        }

        return $this;
    }

    public function removeSupplier(Supplier $supplier): static
    {
        $this->supplier->removeElement($supplier);

        return $this;
    }

    /**
     * @return Collection<int, EnvirometalMetric>
     */
    public function getMaterialEnviromentalMetric(): Collection
    {
        return $this->material_enviromental_metric;
    }

    public function addMaterialEnviromentalMetric(EnvirometalMetric $materialMetric): static
    {
        if (!$this->material_enviromental_metric->contains($materialMetric)) {
            $this->material_enviromental_metric->add($materialMetric);
            $materialMetric->setMaterial($this);
        }

        return $this;
    }

    public function removeMaterialEnviromentalMetric(EnvirometalMetric $materialMetric): static
    {
        if ($this->material_enviromental_metric->removeElement($materialMetric)) {
            // set the owning side to null (unless already changed)
            if ($materialMetric->getMaterial() === $this) {
                $materialMetric->setMaterial(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
