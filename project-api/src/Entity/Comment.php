<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={
 *                             "groups"={"get_comment_with_author"}
 *                          },
 *     denormalizationContext={
 *                                              "groups"={"comment_write"}
 *                                          },
 *     itemOperations={
 *          "get",
 *          "delete",
 *          "put"={
 *                  "access_control"="is_granted('ROLE_COMMENTATOR') or is_granted('ROLE_ADMIN') and object.getUser==user",
 *                  "denormalizationContext"={
 *                                              "groups"={"edit_comment"}
 *                                          },
 *                  "normalizationContext"={
 *                                              "groups"={"get_comment"}
 *                                          }
 *                }
 *
 *     },
 *    collectionOperations={
 *          "get"={
 *                  "access_control"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')",
 *                  "normalizationContext"={
 *                                              "groups"={"get_comment"}
 *                                          }
 *                },
 *
 *          "post"={
 *                  "access_control"="is_granted('IS_AUTHENTICATED_FULLY')",
 *                  "denormalizationContext"={
 *                                              "groups"={"comment_write"}
 *                                          }
 *     },
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
     * @Groups({"get_comment_with_author","comment_write","get_comment_with_reply"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=800)
     * @Groups({"get_comment_with_author","edit","comment_write","get_comment_with_reply"})
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get_comment_with_author","comment_write","get_comment_with_reply"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Projects", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get_comment_with_author","comment_write","get_comment_with_reply"})
     */
    private $projectid;

    /**
     * @var CommentImages|null
     *
     * @ORM\ManyToMany(targetEntity=CommentImages::class)
     * @ORM\JoinTable()
     * @ORM\JoinColumn(nullable=true)
     * @ApiSubresource()
     * @ApiProperty(iri="http://schema.org/image")
     * @Groups({"get_comment_with_author","comment_write"})
     */
    public $image;

    /**
     * @ORM\Column(type="date")
     * @Groups({"get_comment_with_author"})
     */
    private $published;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommentReply", mappedBy="coment_id", orphanRemoval=true)
     * @ApiSubresource()
     */
    private $commentReplies;

    public function __construct()
    {
        $this->commentReplies = new ArrayCollection();
        $this->image=new ArrayCollection();
    }



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
        $this->published=$published;
        return $this;
    }

    public function getPublished(): ?\DateTimeInterface
    {
        return $this->published;
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
            $commentReply->setComentId($this);
        }

        return $this;
    }

    public function removeCommentReply(CommentReply $commentReply): self
    {
        if ($this->commentReplies->contains($commentReply)) {
            $this->commentReplies->removeElement($commentReply);
            // set the owning side to null (unless already changed)
            if ($commentReply->getComentId() === $this) {
                $commentReply->setComentId(null);
            }
        }

        return $this;
    }
    public function __toString(): string{
        return substr($this->message,0,50).'.....';
    }
    public function getImage(): Collection
    {
        return $this->image;
    }

    public function addImage(?CommentImages $image)
    {
        $this->image->add($image);
    }

    public function removeImage(CommentImages $image)
    {
        $this->image->removeElement($image);
    }


}
