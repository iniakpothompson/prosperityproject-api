<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={
 *                             "groups"={"get_comment_with_author"}
 *                          },
 *     itemOperations={
 *          "get",
 *          "delete",
 *          "put"={
 *                  "access_control"="is_granted('ROLE_COMMENTATOR') and object.getUserid==user",
 *                  "denormalizationContext"={
 *                                              "groups"={"edit"}
 *                                          },
 *                  "normalizationContext"={
 *                                              "groups"={"get"}
 *                                          }
 *                }
 *
 *     },
 *    collectionOperations={
 *          "get"={
 *                  "access_control"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')",
 *                  "normalizationContext"={
 *                                              "groups"={"get"}
 *                                          }
 *                },
 *
 *          "post"={"access_control"="is_granted('IS_AUTHENTICATED_FULLY')"},
 *          "api_projects_comments_get_subresource"={
 *                                                      "normalizationContext"={
 *                                                                               "groups"={"get_comment_with_author"}
 *                                                                              }
 *                                                  }
 *     }
 *
 * )
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment implements AuthorEntityInterface, PublishedDateEntityInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get_comment_with_author"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=800)
     * @Groups({"get_comment_with_author","edit"})
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get_comment_with_author"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Projects", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get_comment_with_author"})
     */
    private $projectid;

    /**
     * @var CommentImages|null
     *
     * @ORM\ManyToOne(targetEntity=CommentImages::class)
     * @ORM\JoinColumn(nullable=true)
     * @ApiProperty(iri="http://schema.org/image")
     * @Groups({"get_comment_with_author"})
     */
    public $image;

    /**
     * @ORM\Column(type="date")
     */
    private $date;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

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

    public function getProjectid(): ?Projects
    {
        return $this->projectid;
    }

    public function setProjectid(?Projects $projectid): self
    {
        $this->projectid = $projectid;

        return $this;
    }


    public function setPublished(\DateTimeInterface $published): PublishedDateEntityInterface
    {
        $this->date=$published;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }


}
