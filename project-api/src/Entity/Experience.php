<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={
 *                                    "groups"={"get_user_exp"}
 *                            },
 *     itemOperations={
 *          "get"={
 *                  "access_control"="is_granted('ROLE_GOVERNOR') or is_granted('ROLE_COMMISSIONER') or object==user"
 *          },
 *          "delete",
 *          "put"={
 *                  "access_control"="is_granted('IS_AUTHENTICATED_FULLY') and object==user or is_granted('ROLE_ADMIN')",
 *                  "denormalizationContext"={
 *                                              "groups"={"edit"}
 *                                           }
 *              },
 *
 *     },
 *     collectionOperations={
 *                      "get"={
 *                                  "access_control"="is_granted('ROLE_COMMISSIONER') or is_granted('ROLE_GOVERNOR')"
 *                          },
 *          "post"={
 *                      "access_control"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"
 *                  },
 *          "api_users_experiences_get_subresource"={
*                                                       "normalizationContext"={
 *                                                                              "groups"={"get_user_exp"}
 *                                                                          }
 *                                                    }
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ExperienceRepository")
 */
class Experience
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get_user_exp"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get_user_exp"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=300)
     * @Groups({"get_user_exp"})
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     * @Groups({"get_user_exp"})
     */
    private $startdate;

    /**
     * @ORM\Column(type="date")
     * @Groups({"get_user_exp"})
     */
    private $enddate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="experience")
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $userid;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get_user_exp"})
     */
    private $jobplace;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getJobplace(): ?string
    {
        return $this->jobplace;
    }

    public function setJobplace(string $jobplace): self
    {
        $this->jobplace = $jobplace;

        return $this;
    }
}
