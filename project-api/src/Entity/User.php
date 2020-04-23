<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;
use App\Controller\ResetPasswordAction;


/**
 * @ApiResource(
 *     attributes={
 *     "oder"={"name":"ASC"},
 *     "pagination_items_per_page":20
 *     },
 *     normalizationContext={
 *                                    "groups"={"get","get_users"}
 *                            },
 *     itemOperations={
 *          "get"={
 *                  "access_control"="is_granted('ROLE_GOVERNOR') or is_granted('ROLE_COMMISSIONER') or object==user"
 *          },
 *          "delete",
 *          "put"={
 *                  "access_control"="is_granted('IS_AUTHENTICATED_FULLY') or object==user",
 *                  "denormalizationContext"={
 *                                              "groups"={"edit","put-reset-password"}
 *                                           }
 *              },
 *            "put-reset-password"={
 *             "access_control"="is_granted('IS_AUTHENTICATED_FULLY') and object == user",
 *             "method"="PUT",
 *             "path"="/users/{id}/reset-password",
 *             "controller"=ResetPasswordAction::class,
 *             "denormalization_context"={
 *                 "groups"={"put-reset-password"}
 *             },
 *             "validation_groups"={"put-reset-password"},
 *                      "swagger_context"={
 *                                          "summary" = "Change user password"
 *                                         }
 *                  }
 *
 *     },
 *     collectionOperations={
 *                      "get"={
 *                      "access_control"="is_granted('ROLE_COMMISSIONER') or is_granted('ROLE_GOVERNOR')",
 *                      "groups"={"get_users"}
 *     },
 *          "post"={
 *                      "access_control"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')",
 *                      "denormalizationContext"={
 *                                                 "groups"={"post"}
 *                                              }
 *                  }
 *     }
 * )
 *
 * @ApiFilter(SearchFilter::class, properties={"id":"exact", "name":"exact", "email":"exact"})
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *
 */
class User implements UserInterface
{
    const ROLE_GOVERNOR='ROLE_GOVERNOR';
    const ROLE_MINISTRY_DESK_OFFICER='ROLE_MINISTRY_DESK_OFFICER';
    const ROLE_COMMENTATOR='ROLE_COMMENTATOR';
    const ROLE_COMMISSIONER='ROLE_COMMISSIONER';
    const ROLE_ADMIN='ROLE_ADMIN';
    const DEFAULT_ROLE=[self::ROLE_COMMENTATOR];
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get","get_Projects_under_ministry"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(groups={"post"})
     * @Assert\NotBlank(groups={"post"})
     * @Assert\Length(max="50", maxMessage="Name longer than expected, allowed characters 50",
     * groups={"post","edit"}
     * )
     * @Groups({"get_users","edit","post","get_comment_with_author","get_user_edu","get_user_cert","get_Projects_under_ministry"})
     */
    private $name;



    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Assert\NotNull(groups={"post"})
     * @Assert\NotBlank(groups={"post"})
     * @Groups({"get_users","edit","post"})
     */
    private $sex;

    /**
     * @ORM\Column(type="string", length=30, nullable=false)
     * @Groups({"get_users","edit","post","get_Projects_under_ministry"})
     * @Assert\NotNull(groups={"post"})
     * @Assert\NotBlank(groups={"post"})
     */
    private $designation;


    /**
     * @ORM\Column(name="is_active", type="boolean")
     * @Groups({"get_users"})
     */
    private $isActive;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotNull(groups={"post"})
     * @Assert\NotBlank(groups={"post"})
     * @Assert\Length(max="15", maxMessage="This Field cannot be longer than expected, allowed characters 15",
     *     groups={"post","edit"}
     *     )
     * @Groups({"get_users","edit","post"})
     */
    private $phone;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=30, unique=true, nullable=false)
     * @Assert\Length(max="50", maxMessage="This Field cannot be longer than expected, allowed characters 50",
     *                  groups={"post"}
     * )
     * @Groups({"get_users","get_comment_with_author","post"})
     */
    private $email;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\NotNull(groups={"post"})
     * @Assert\NotBlank(groups={"post"})
     * @Groups({"get_users","edit","post"})
     *
     */
    private $dob;
    /**
     *
     * @ORM\Column(type="string", length=500)
     * @Assert\NotBlank(groups={"post"})
     * @Assert\Regex(
     *     pattern="/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]),{7,}/",
     *     message="Password must be at least seven characters long and contain at least one digit, one uppercase letter",
     *     groups={"post"}
     * )
     * @Groups({"post","edit"})
     */
    private $password;

    /**
     *@Assert\NotBlank(groups={"post"})
     * @Assert\Expression("this.getPassword()==this.getConfirmpassword()",
     *                      message="Passwords Does not Match typed password",
     *                      groups={"post"}
     * )
     */
    private $confirmpassword;

    /**
     * @Groups({"put-reset-password"})
     * @Assert\NotBlank(groups={"put-reset-password"})
     * @Assert\Regex(
     *     pattern="/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{7,}/", groups={"put-reset-password"},
     *     message="Password must be seven characters long and contain at least one digit, one upper case letter and one lower case letter"
     *
     * )
     */
    private $newPassword;

    /**
     * @Groups({"put-reset-password"})
     * @Assert\NotBlank(groups={"put-reset-password"})
     * @Assert\Expression(
     *     "this.getNewPassword() === this.getNewRetypedPassword()",
     *     message="Passwords does not match",
     *     groups={"put-reset-password"}
     * )
     */
    private $newRetypedPassword;

    /**
     * @Groups({"put-reset-password"})
     * @Assert\NotBlank(groups={"put-reset-password"})
     * @UserPassword(groups={"put-reset-password"})
     */
    private $oldPassword;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Experience", mappedBy="userid", orphanRemoval=true)
     * @Groups({"get_users","edit","post","get_Projects_under_ministry"})
     * @ApiSubresource()
     */
    private $experience;

    /**
     * @Assert\NotNull(groups={"post"})
     * @Assert\NotBlank(groups={"post"})
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max="300", maxMessage="This Field cannot be longer than expected, allowed characters 300",
     * groups={"post","edit"}
     * )
     * @Groups({"get_users","edit","post",})
     */
    private $careerobjs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Education", mappedBy="userid", orphanRemoval=true)
     * @Groups({"get_users","post"})
     * @ApiSubresource()
     *
     */
    private $education;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Projects", mappedBy="userid")
     * @Groups({"project_comments_get","post","get_users"})
     */
    private $projects;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="user", orphanRemoval=true)
     * @Groups({"comments_get","post","get_users"})
     */
    private $comments;

    /**
     * @var UserProfileImages|null
     *
     * @ORM\ManyToOne(targetEntity=UserProfileImages::class)
     * @ORM\JoinColumn(nullable=true)
     * @ApiProperty(iri="http://schema.org/image")
     * @ApiSubresource()
     * @Groups({"get","post","get_users"})
     */
    public $image;

    /**
     * @ORM\Column(type="simple_array", nullable=false, length=200)
     * @Groups({"get_users","post","edit"})
     */
    private $roles;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Projects", mappedBy="user")
     * @Groups({"projects_get","post","get_users"})
     */
    private $project;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ministries", mappedBy="user")
     * @Groups({"get_users","post","edit"})
     */
    private $ministries;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Certificate", mappedBy="user", orphanRemoval=true)
     * @Groups({"get_users","post"})
     */
    private $cert;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $passwordChangeDate;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $confirmationToken;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommentReply", mappedBy="replyer", orphanRemoval=true)
     */
    private $commentReplies;


    public function getPasswordChangeDate()
    {
        return $this->passwordChangeDate;
    }

    /**
     * @param mixed $passwordChangeDate
     */
    public function setPasswordChangeDate($passwordChangeDate): void
    {
        $this->passwordChangeDate = $passwordChangeDate;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }


    public function __construct()
    {
        $this->experience = new ArrayCollection();
        $this->education = new ArrayCollection();
        $this->certgrade = new ArrayCollection();
        $this->projects = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->roles=self::DEFAULT_ROLE;
        $this->isActive = false;
        $this->confirmationToken=null;
        $this->designation='COMMENTATOR';
        $this->project = new ArrayCollection();
        $this->ministries = new ArrayCollection();
        $this->cert = new ArrayCollection();
        $this->commentReplies = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getCareerobjs(): ?string
    {
        return $this->careerobjs;
    }

    public function setCareerobjs(?string $careerobjs)
    {
        $this->careerobjs = $careerobjs;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     *
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;
    }

    public function getDob(): ?DateTime
    {
        return $this->dob;
    }

    public function setDob(DateTime $dob)
    {
        $this->dob = $dob;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone)
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }



    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
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
            // set the owning side to null (unless algety changed)
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
            // set the owning side to null (unless algety changed)
            if ($education->getUserid() === $this) {
                $education->setUserid(null);
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
            // set the owning side to null (unless algety changed)
            if ($comment->getUserid() === $this) {
                $comment->setUserid(null);
            }
        }

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
//        return array('ROLE_ADMIN');
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;
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
        return $this->getEmail();
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @return mixed
     */
    public function getConfirmpassword()
    {
        return $this->confirmpassword;
    }

    /**
     * @param mixed $confirmpassword
     */
    public function setConfirmpassword($confirmpassword)
    {
        $this->confirmpassword = $confirmpassword;
    }

    /**
     * @return Collection|Projects[]
     */
    public function getProject(): Collection
    {
        return $this->project;
    }

    /**
     * @return Collection|Ministries[]
     */
    public function getMinistries(): Collection
    {
        return $this->ministries;
    }

    public function addMinistry(Ministries $ministry): self
    {
        if (!$this->ministries->contains($ministry)) {
            $this->ministries[] = $ministry;
            $ministry->setUser($this);
        }

        return $this;
    }

    public function removeMinistry(Ministries $ministry): self
    {
        if ($this->ministries->contains($ministry)) {
            $this->ministries->removeElement($ministry);
            // set the owning side to null (unless algety changed)
            if ($ministry->getUser() === $this) {
                $ministry->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Certificate[]
     */
    public function getCert(): Collection
    {
        return $this->cert;
    }

    public function addCert(Certificate $cert): self
    {
        if (!$this->cert->contains($cert)) {
            $this->cert[] = $cert;
            $cert->setUser($this);
        }

        return $this;
    }

    public function removeCert(Certificate $cert): self
    {
        if ($this->cert->contains($cert)) {
            $this->cert->removeElement($cert);
            // set the owning side to null (unless already changed)
            if ($cert->getUser() === $this) {
                $cert->setUser(null);
            }
        }

        return $this;
    }

    /**
     *
     */
    public function getNewPassword(): ?string
    {
        return $this->newPassword;
    }

    public function setNewPassword($newPassword): void
    {
        $this->newPassword = $newPassword;
    }

    public function getNewRetypedPassword(): ?string
    {
        return $this->newRetypedPassword;
    }

    public function setNewRetypedPassword($newRetypedPassword): void
    {
        $this->newRetypedPassword = $newRetypedPassword;
    }

    public function getOldPassword(): ?string
    {
        return $this->oldPassword;
    }

    public function setOldPassword($oldPassword): void
    {
        $this->oldPassword = $oldPassword;
    }

    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    public function setConfirmationToken($confirmationToken): void
    {
        $this->confirmationToken = $confirmationToken;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @return Collection|CommentReply[]
     */
    public function getCommentReplies(): Collection
    {
        return $this->commentReplies;
    }

    public function addCommentReply(CommentReply $commentReply): self
    {
        if (!$this->commentReplies->contains($commentReply)) {
            $this->commentReplies[] = $commentReply;
            $commentReply->setUser($this);
        }

        return $this;
    }

    public function removeCommentReply(CommentReply $commentReply): self
    {
        if ($this->commentReplies->contains($commentReply)) {
            $this->commentReplies->removeElement($commentReply);
            // set the owning side to null (unless already changed)
            if ($commentReply->getUser() === $this) {
                $commentReply->setUser(null);
            }
        }

        return $this;
    }




}
