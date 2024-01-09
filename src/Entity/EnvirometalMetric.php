<?php

namespace App\Entity;

use App\Repository\EnvirometalMetricRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnvirometalMetricRepository::class)]
class EnvirometalMetric
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $value = null;

    #[ORM\ManyToOne(inversedBy: 'envirometalMetrics')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MetricType $metric_type = null;

    #[ORM\ManyToOne(inversedBy: 'material_metric')]
    private ?Material $material = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(?float $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getMetricType(): ?MetricType
    {
        return $this->metric_type;
    }

    public function setMetricType(?MetricType $metric_type): static
    {
        $this->metric_type = $metric_type;

        return $this;
    }

    public function getMaterial(): ?Material
    {
        return $this->material;
    }

    public function setMaterial(?Material $material): static
    {
        $this->material = $material;

        return $this;
    }
}
