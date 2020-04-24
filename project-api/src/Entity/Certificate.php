<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={
 *                                    "groups"={"get_user_cert"}
 *
 *
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
 *
 *     "api_users_education_certgrades_get_subresource"={
 *                                                           "normalizationContext"={
 *                                                                                  "groups"={"get_user_cert"}
 *
 *
 *                                                                                 }
 *                                                        }
 *     }
 * )
 *
 * @ORM\Entity(repositoryClass="App\Repository\CertificateRepository")
 */
class Certificate
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get_user_cert"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get_user_cert","get_user_edu"})
     */
    private $subject;

    /**
     * @ORM\Column(type="string", length=5)
     * @Groups({"get_user_cert","get_user_edu"})
     */
    private $grade;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Education", inversedBy="certgrade")
     * @ORM\JoinColumn(nullable=false)
     *@Groups({"get_user_cert"})
     */
    private $educationid;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="cert")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get_user_cert"})
     */
    private $user;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getEducationid(): ?Education
    {
        return $this->educationid;
    }

    public function setEducationid(?Education $educationid): self
    {
        $this->educationid = $educationid;

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
    public function __toString() :string 
    {
        return $this->grade;
    }

}
