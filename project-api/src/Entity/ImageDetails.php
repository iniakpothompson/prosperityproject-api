<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiSubresource;

/**
 * @ApiResource(
 *     normalizationContext={
 *                             "groups"={"projectimage_object_read"}
 *                          },
 *     collectionOperations={
 *                              "get",
 *                              "post"
 *                          }
 *
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ImageDetailsRepository")
 */
class ImageDetails
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"projectimage_object_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"projectimage_object_read"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"projectimage_object_read"})
     */
    private $phase;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ProjectImages", inversedBy="imageDetails")
     *
     * @ApiSubresource()
     *
     */
    private $image;

    public function __construct()
    {
        $this->image = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPhase(): ?string
    {
        return $this->phase;
    }

    public function setPhase(string $phase): self
    {
        $this->phase = $phase;

        return $this;
    }

    /**
     * @return Collection|ProjectImages[]
     */
    public function getImage(): Collection
    {
        return $this->image;
    }

    public function addImage(ProjectImages $image): self
    {
        if (!$this->image->contains($image)) {
            $this->image[] = $image;
        }

        return $this;
    }

    public function removeImage(ProjectImages $image): self
    {
        if ($this->image->contains($image)) {
            $this->image->removeElement($image);
        }

        return $this;
    }


}
