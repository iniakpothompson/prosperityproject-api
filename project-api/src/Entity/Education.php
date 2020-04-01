<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\EducationRepository")
 */
class Education
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
    private $school;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $edulevel;

    /**
     * @ORM\Column(type="date")
     */
    private $startdate;

    /**
     * @ORM\Column(type="date")
     */
    private $enddate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="education")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userid;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Certificate", mappedBy="educationid", orphanRemoval=true)
     */
    private $certgrade;

    public function __construct()
    {
        $this->certgrade = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSchool(): ?string
    {
        return $this->school;
    }

    public function setSchool(string $school): self
    {
        $this->school = $school;

        return $this;
    }

    public function getEdulevel(): ?string
    {
        return $this->edulevel;
    }

    public function setEdulevel(string $edulevel): self
    {
        $this->edulevel = $edulevel;

        return $this;
    }

    public function getStartdate(): ?\DateTimeInterface
    {
        return $this->startdate;
    }

    public function setStartdate(\DateTimeInterface $startdate): self
    {
        $this->startdate = $startdate;

        return $this;
    }

    public function getEnddate(): ?\DateTimeInterface
    {
        return $this->enddate;
    }

    public function setEnddate(\DateTimeInterface $enddate): self
    {
        $this->enddate = $enddate;

        return $this;
    }

    public function getUserid(): ?User
    {
        return $this->userid;
    }

    public function setUserid(?User $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * @return Collection|Certificate[]
     */
    public function getCertgrade(): Collection
    {
        return $this->certgrade;
    }

    public function addCertgrade(Certificate $certgrade): self
    {
        if (!$this->certgrade->contains($certgrade)) {
            $this->certgrade[] = $certgrade;
            $certgrade->setEducationid($this);
        }

        return $this;
    }

    public function removeCertgrade(Certificate $certgrade): self
    {
        if ($this->certgrade->contains($certgrade)) {
            $this->certgrade->removeElement($certgrade);
            // set the owning side to null (unless already changed)
            if ($certgrade->getEducationid() === $this) {
                $certgrade->setEducationid(null);
            }
        }

        return $this;
    }
}
