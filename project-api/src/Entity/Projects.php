<?php

namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;


/**
 * @ApiResource()
 * @ApiFilter(SearchFilter::class, properties={"id":"exact", "title":"partial","community":"exact","lga":"exact"} )
 * @ApiFilter(DateFilter::class, properties={"startdate":"exact"})
 * @ApiFilter(BooleanFilter::class, properties={"makepublic"})
 * @ORM\Entity(repositoryClass="App\Repository\ProjectsRepository")
 */
class Projects
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $community;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lga;

    /**
     * @ORM\Column(type="date")
     */
    private $startdate;

    /**
     * @ORM\Column(type="date")
     *
     */
    private $expectedenddate;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $projectsummary;

    /**
     * @ORM\Column(type="boolean")
     */
    private $makepublic;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ministries", inversedBy="projectImages")
     */
    private $ministryid;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="projectImages")
     */
    private $userid;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="projectid", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProjectPayments", mappedBy="projectid", orphanRemoval=true)
     */
    private $payments;

    /**
     * @var ProjectImages|null
     *
     * @ORM\ManyToOne(targetEntity=ProjectImages::class)
     * @ORM\JoinColumn(nullable=true)
     * @ApiProperty(iri="http://schema.org/image")
     */
    public $image;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $cost;

    public function __construct()
    {
        $this->ministryid = new ArrayCollection();
        $this->userid = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->payments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCommunity(): ?string
    {
        return $this->community;
    }

    public function setCommunity(string $community): self
    {
        $this->community = $community;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getLga(): ?string
    {
        return $this->lga;
    }

    public function setLga(string $lga): self
    {
        $this->lga = $lga;

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

    public function getExpectedenddate(): ?\DateTimeInterface
    {
        return $this->expectedenddate;
    }

    public function setExpectedenddate(\DateTimeInterface $expectedenddate): self
    {
        $this->expectedenddate = $expectedenddate;

        return $this;
    }

    public function getProjectsummary(): ?string
    {
        return $this->projectsummary;
    }

    public function setProjectsummary(string $projectsummary): self
    {
        $this->projectsummary = $projectsummary;

        return $this;
    }

    public function getMakepublic(): ?bool
    {
        return $this->makepublic;
    }

    public function setMakepublic(bool $makepublic): self
    {
        $this->makepublic = $makepublic;

        return $this;
    }

    /**
     * @return Collection|Ministries[]
     */
    public function getMinistryid(): Collection
    {
        return $this->ministryid;
    }

    public function addMinistryid(Ministries $ministryid): self
    {
        if (!$this->ministryid->contains($ministryid)) {
            $this->ministryid[] = $ministryid;
        }

        return $this;
    }

    public function removeMinistryid(Ministries $ministryid): self
    {
        if ($this->ministryid->contains($ministryid)) {
            $this->ministryid->removeElement($ministryid);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUserid(): Collection
    {
        return $this->userid;
    }

    public function addUserid(User $userid): self
    {
        if (!$this->userid->contains($userid)) {
            $this->userid[] = $userid;
        }

        return $this;
    }

    public function removeUserid(User $userid): self
    {
        if ($this->userid->contains($userid)) {
            $this->userid->removeElement($userid);
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setProjectid($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getProjectid() === $this) {
                $comment->setProjectid(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProjectPayments[]
     */
    public function getPayments(): Collection
    {
        return $this->payments;
    }

    public function addPayment(ProjectPayments $payment): self
    {
        if (!$this->payments->contains($payment)) {
            $this->payments[] = $payment;
            $payment->setProjectid($this);
        }

        return $this;
    }

    public function removePayment(ProjectPayments $payment): self
    {
        if ($this->payments->contains($payment)) {
            $this->payments->removeElement($payment);
            // set the owning side to null (unless already changed)
            if ($payment->getProjectid() === $this) {
                $payment->setProjectid(null);
            }
        }

        return $this;
    }

    public function getCost(): ?string
    {
        return $this->cost;
    }

    public function setCost(string $cost): self
    {
        $this->cost = $cost;

        return $this;
    }
}
