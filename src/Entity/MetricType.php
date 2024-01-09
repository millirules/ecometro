<?php

namespace App\Entity;

use App\Repository\MetricTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MetricTypeRepository::class)]
class MetricType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'metric_type', targetEntity: EnvirometalMetric::class, orphanRemoval: true)]
    private Collection $envirometalMetrics;

    public function __construct()
    {
        $this->envirometalMetrics = new ArrayCollection();
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
     * @return Collection<int, EnvirometalMetric>
     */
    public function getEnvirometalMetrics(): Collection
    {
        return $this->envirometalMetrics;
    }

    public function addEnvirometalMetric(EnvirometalMetric $envirometalMetric): static
    {
        if (!$this->envirometalMetrics->contains($envirometalMetric)) {
            $this->envirometalMetrics->add($envirometalMetric);
            $envirometalMetric->setMetricType($this);
        }

        return $this;
    }

    public function removeEnvirometalMetric(EnvirometalMetric $envirometalMetric): static
    {
        if ($this->envirometalMetrics->removeElement($envirometalMetric)) {
            // set the owning side to null (unless already changed)
            if ($envirometalMetric->getMetricType() === $this) {
                $envirometalMetric->setMetricType(null);
            }
        }

        return $this;
    }
}
