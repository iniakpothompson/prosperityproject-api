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
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={
 *                      "groups"={"get","get_ministry"}
 *     },
 *  denormalizationContext={
 *                      "groups"={"edit_ministry"}
 *                  },
 *     itemOperations={
 *          "get",
 *          "delete"={"access_control"="is_granted('ROLE_ADMIN')"},
 *          "put"={
 *                  "access_control"="is_granted('ROLE_MINISTRY_DESK_OFFICER') or object.getUser()==user",
 *                  "denormalizationContext"={
 *                      "groups"={"edit_ministry"}
 *                  }
 *                 },
 *
 *    },
 *     collectionOperations={
 *          "get"={
 *                 "normalizationContext"={
 *                      "groups"={"edit_ministry","get_ministry"}
 *                  }
 *     },
 *          "post"={"access_control"="is_granted('ROLE_MINISTRY_DESK_OFFICER')"}
 *
 *     },

 * )
 * @ApiFilter(SearchFilter::class, properties={"id":"exact", "name":"exact"})
 * @ORM\Entity(repositoryClass="App\Repository\MinistriesRepository")
 */
class Ministries
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get_ministry","get_Projects_under_ministry"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get_ministry","edit_ministry","get_Projects_under_ministry"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"get_ministry","get_Projects_under_ministry","edit_ministry"})
     */
    private $code;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Projects", mappedBy="ministryid")
     *
     * @ApiSubresource()
     */
    private $projects;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ministries")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity=MinistryImage::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * @ApiSubresource()
     * @ApiProperty(iri="http://schema.org/image")
     * @Groups({"get","get_ministry","edit_ministry"})
     */
    private $image;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection|Projects[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Projects $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->addMinistryid($this);
        }

        return $this;
    }

    public function removeProject(Projects $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            $project->removeMinistryid($this);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user)
    {
        $this->user = $user;
    }

    public function getImage(): ?MinistryImage
    {
        return $this->image;
    }

    public function setImage(?MinistryImage $image): self
    {
        $this->image = $image;

        return $this;
    }
    public function __toString(): string{
        return $this->name;
    }
}
