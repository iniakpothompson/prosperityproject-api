<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={
 *              "groups"={"get_comment_with_reply"}
 *     },
 *    denormalizationContext={
 *
 *          "groups"={"edit_reply","post_reply"}
 *
 *     },
 *      itemOperations={
 *          "get"={
 *              "normalizationContext"={
 *                                              "groups"={"get_comment_with_reply"}
 *                                          }
 *     },
 *          "put"={
 *                      "denormalizationContext"={
 *                                                  "groups"={"edit_reply"}
 *                                              },
 *                      "normalizationContext"={
 *                                              "groups"={"get_comment_with_reply"}
 *                                          }
 *     }
 *
 *     },
 *     collectionOperations={
 *          "get"={
 *                                          "normalizationContext"={
 *                                              "groups"={"get_comment_with_reply"}
 *                                          }
 *                          },
 *          "api_comments_comment_replies_get_subresource"={
 *                          "normalizationContext"={
 *                                  "groups"={"get_comment_with_reply"}
 *                              }
 *              },
 *          "post"={
 *                      "access_control"="is_granted('ROLE_COMMENTATOR')",
 *                      "denormalizationContext"={
 *                                                  "groups"={"post_reply"}
 *                                      }
 *
 *                      }
 *     }
 *
 * )
 * @ORM\Entity(repositoryClass="App\Repository\CommentReplyRepository")
 */

class CommentReply implements AuthorEntityInterface, PublishedDateEntityInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get_comment_with_reply"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     * @Groups({"get_comment_with_reply","edit_reply","post_reply"})
     */
    private $reply_message;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Comment", inversedBy="commentReplies")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get_comment_with_reply","post_reply"})
     */
    private $coment_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="commentReplies")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get_comment_with_reply","post_reply"})
     */
    private $user;

    /**
     * @ORM\Column(type="date")
     * @Groups({"get_comment_with_reply","post_reply"})
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReplyMessage(): ?string
    {
        return $this->reply_message;
    }

    public function setReplyMessage(?string $reply_message): self
    {
        $this->reply_message = $reply_message;

        return $this;
    }

    public function getComentId(): ?Comment
    {
        return $this->coment_id;
    }

    public function setComentId(?Comment $coment_id)
    {
        $this->coment_id = $coment_id;

        //return $this;
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

    /**
     * @return mixed
     */
    public function getDate():? \DateTimeInterface
    {
        return $this->date;
    }

    public function setPublished(\DateTimeInterface $published): PublishedDateEntityInterface
    {
        $this->date=$published;
        return $this;
    }
    public function __toString(): string{
        return $this->reply_message;
    }
}
