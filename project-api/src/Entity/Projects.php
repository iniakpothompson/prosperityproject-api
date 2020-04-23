<?php

namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(
 *     normalizationContext={
 *                       "groups"={"get_Projects_under_ministry","get_projects"}
 *     },
 *     denormalizationContext={
 *              "groups"={"edit_project","post_project"}
 *     },
 *     itemOperations={
 *          "get",
 *          "delete",
 *          "put"={
 *                      "access_control"="is_granted('ROLE_MINISTRY_DESK_OFFICER') and object.user==getUser",
 *                      " denormalizationContext"={
 *                                                  "groups"={"edit_project"}
 *                                              },
 *                      "normalizationContext"={
 *                                              "groups"={"get_project"}
 *                                          }
 *                 }
 *
 *     },
 *
 *     collectionOperations={
 *          "get"={
 *                     " normalizationContext"={
 *                                                  "groups"={"get","get_projects"}
 *                                             }
 *                },
 *          "post"={"access_control"="is_granted('ROLE_MINISTRY_DESK_OFFICER')",
 *                      "denormalizationContext"={
 *              "groups"={"post_project"}
 *     }
 *     },
 *           "api_ministries_projects_get_subresource"={
 *                                                                   "normalizationContext"={
 *                                                                               "groups"={"get_Projects_under_ministry"}
 *                                                                              }
 *                                          }
 *
 *     },
 *
 * )
 * @ApiFilter(SearchFilter::class, properties={"id":"exact", "title":"partial","community":"exact","lga":"exact"} )
 * @ApiFilter(DateFilter::class, properties={"startdate":"exact"})
 * @ApiFilter(BooleanFilter::class, properties={"makepublic"})
 * @ORM\Entity(repositoryClass="App\Repository\ProjectsRepository")
 */
class Projects implements AuthorEntityInterface, PublishedDateEntityInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get_project","post_project","get_Projects_under_ministry"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get_project","edit_project","post_project","get_comment_with_author","get_Projects_under_ministry"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get_project","edit_project","post_project","get_comment_with_author","get_Projects_under_ministry"})
     */
    private $community;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get_project","edit_project","post_project","get_comment_with_author","get_Projects_under_ministry"})
     */
    private $location;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get_project","edit_project","post_project","get_comment_with_author","get_Projects_under_ministry"})
     */
    private $lga;

    /**
     * @ORM\Column(type="date")
     * @Groups({"get_project","edit_project","post_project","get_Projects_under_ministry"})
     */
    private $startdate;

    /**
     * @ORM\Column(type="date")
     * @Groups({"get_project","edit_project","get_Projects_under_ministry","post_project"})
     *
     */
    private $expectedenddate;

    /**
     * @ORM\Column(type="date")
     * @Groups({"get_Projects_under_ministry","get_project","edit_project","post_project"})
     */
    private $uploaddate;

    /**
     * @ORM\Column(type="string", length=500)
     * @Groups({"get_project","edit_project", "post_project","get_Projects_under_ministry"})
     */
    private $projectsummary;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"get_project","edit_project","post_project"})
     */
    private $makepublic;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ministries", inversedBy="projectImages")
     * @Groups({"get_project","edit_project","post_project","get_Projects_under_ministry"})
     */
    private $ministryid;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="projectImages")
     * @Groups({"projectcomment_image_get"})
     */
    private $userid;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="projectid", orphanRemoval=true)
     * @Groups({"get_project","get_Projects_under_ministry"})
     * @ApiSubresource()
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProjectPayments", mappedBy="projectid", orphanRemoval=true)
     * @Groups({"get_project","post_project","get_Projects_under_ministry"})
     * @ApiSubresource()
     */
    private $payments;

    /**
     * @var ProjectImages|null
     *
     * @ORM\ManyToOne(targetEntity=ProjectImages::class)
     * @ORM\JoinColumn(nullable=true)
     * @ApiSubresource()
     * @ApiProperty(iri="http://schema.org/image")
     * @Groups({"get_projects","post_project","get_Projects_under_ministry"})
     */
    public $image;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     * @Groups({"get_project","post_project","edit_project","get_Projects_under_ministry"})
     */
    private $cost;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="project")
     * @Groups({"get_project","post_project","get_Projects_under_ministry"})
     */
    private $user;



    public function __construct()
    {
        $this->ministryid = new ArrayCollection();
        $this->userid = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->payments = new ArrayCollection();
        $this->contractor = new ArrayCollection();
        $this->pro_engineer = new ArrayCollection();
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
            // set the owning side to null (unless algety changed)
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
            // set the owning side to null (unless algety changed)
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

    public function setCost(string $cost)
    {
        $this->cost = $cost;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(UserInterface $user): AuthorEntityInterface
    {
        $this->user = $user;
        return $this;
    }


    public function getUploaddate(): ?\DateTimeInterface
    {
        return $this->uploaddate;
    }

    public function setPublished(\DateTimeInterface $update): PublishedDateEntityInterface
    {
        $this->uploaddate=$update;
        return $this;
    }
    public function __toString(): string{
        return $this->title;
    }

}
