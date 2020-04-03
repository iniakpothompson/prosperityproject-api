<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ApiResource()
 * @ApiFilter(SearchFilter::class, properties={"id":"exact", "name":"exact", "email":"exact"})
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $careerobjs;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $sex;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dob;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=30, unique=true, nullable=false)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Experience", mappedBy="userid", orphanRemoval=true)
     */
    private $experience;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Education", mappedBy="userid", orphanRemoval=true)
     */
    private $education;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Certificate", mappedBy="userid")
     */
    private $certgrade;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Projects", mappedBy="userid")
     */
    private $projects;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="userid", orphanRemoval=true)
     */
    private $comments;

    /**
     * @var UserProfileImages|null
     *
     * @ORM\ManyToOne(targetEntity=UserProfileImages::class)
     * @ORM\JoinColumn(nullable=true)
     * @ApiProperty(iri="http://schema.org/image")
     */
    public $image;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;


    public function __construct($email)
    {
        $this->experience = new ArrayCollection();
        $this->education = new ArrayCollection();
        $this->certgrade = new ArrayCollection();
        $this->projects = new ArrayCollection();
        $this->comments = new ArrayCollection();

        $this->isActive = true;
        $this->email = $email;
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

    public function getCareerobjs(): ?string
    {
        return $this->careerobjs;
    }

    public function setCareerobjs(?string $careerobjs): self
    {
        $this->careerobjs = $careerobjs;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getDob(): ?\DateTimeInterface
    {
        return $this->dob;
    }

    public function setDob(\DateTimeInterface $dob): self
    {
        $this->dob = $dob;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
    }

    /**
     * @return Collection|Experience[]
     */
    public function getExperience(): Collection
    {
        return $this->experience;
    }

    public function addExperience(Experience $experience): self
    {
        if (!$this->experience->contains($experience)) {
            $this->experience[] = $experience;
            $experience->setUserid($this);
        }

        return $this;
    }

    public function removeExperience(Experience $experience): self
    {
        if ($this->experience->contains($experience)) {
            $this->experience->removeElement($experience);
            // set the owning side to null (unless already changed)
            if ($experience->getUserid() === $this) {
                $experience->setUserid(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Education[]
     */
    public function getEducation(): Collection
    {
        return $this->education;
    }

    public function addEducation(Education $education): self
    {
        if (!$this->education->contains($education)) {
            $this->education[] = $education;
            $education->setUserid($this);
        }

        return $this;
    }

    public function removeEducation(Education $education): self
    {
        if ($this->education->contains($education)) {
            $this->education->removeElement($education);
            // set the owning side to null (unless already changed)
            if ($education->getUserid() === $this) {
                $education->setUserid(null);
            }
        }

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
            $certgrade->setUserid($this);
        }

        return $this;
    }

    public function removeCertgrade(Certificate $certgrade): self
    {
        if ($this->certgrade->contains($certgrade)) {
            $this->certgrade->removeElement($certgrade);
            // set the owning side to null (unless already changed)
            if ($certgrade->getUserid() === $this) {
                $certgrade->setUserid(null);
            }
        }

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
            $project->addUserid($this);
        }

        return $this;
    }

    public function removeProject(Projects $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            $project->removeUserid($this);
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
            $comment->setUserid($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getUserid() === $this) {
                $comment->setUserid(null);
            }
        }

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return array('ROLE_USER');
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
