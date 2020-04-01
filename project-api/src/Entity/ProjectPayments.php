<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ProjectPaymentsRepository")
 */
class ProjectPayments
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
    private $purpose;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $amount;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phase;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Projects", inversedBy="payments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $projectid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPurpose(): ?string
    {
        return $this->purpose;
    }

    public function setPurpose(string $purpose): self
    {
        $this->purpose = $purpose;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getPhase(): ?string
    {
        return $this->phase;
    }

    public function setPhase(string $phase): self
    {
        $this->phase = $phase;

        return $this;
    }

    public function getProjectid(): ?Projects
    {
        return $this->projectid;
    }

    public function setProjectid(?Projects $projectid): self
    {
        $this->projectid = $projectid;

        return $this;
    }
}
