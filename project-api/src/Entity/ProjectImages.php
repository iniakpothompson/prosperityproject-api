<?php


namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Controller\CreateProjectImageAction;

/**
 * @ORM\Entity()
 * @Vich\Uploadable()
 * @ApiResource(
 *      iri="http://schema.org/ProjectImages",
 *  normalizationContext={
 *         "groups"={"projectimage_object_read"}
 *     },
 *     attributes={
 *         "order"={"id": "ASC"},
 *         "formats"={"json", "jsonld", "form"={"multipart/form-data"}},
 *          "properties"={
 *                          "file"={
 *                          "type"="string",
 *                          "format"="binary"
 *                                  }
 *                      }
 *     },
 *     collectionOperations={
 *         "get",
 *         "post"={
 *             "validation_groups"={"Default", "projectimage_object_create"},
 *             "deserialize"=false,
 *             "controller"=CreateProjectImageAction::class,
 *             "openapi_context"={
 *                 "requestBody"={
 *                     "content"={
 *                         "multipart/form-data"={
 *                             "schema"={
 *                                 "type"="object",
 *                                 "properties"={
 *                                     "file"={
 *                                         "type"="string",
 *                                         "format"="binary"
 *                                     }
 *                                 }
 *                             }
 *                         }
 *                     }
 *                 }
 *             }
 *
 *         },
 *     "api_image_details_images_get_subresource"={
 *                                                   "normalizationContext"={"groups"={"projectimage_object_read"}}
 *                                                      },
 *
 *     },
 *     itemOperations={
 *         "get",
 *         "delete"={
 *             "access_control"="is_granted('ROLE_MINISTRY_DESK_OFFICER')"
 *         }
 *     }
 * )
 * @Vich\Uploadable
 */

class ProjectImages
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"projectimage_object_read","projectimage_object_create"})
     */
    private $id;

    /**
     *
     * @Vich\UploadableField(mapping="projectImages", fileNameProperty="url")
     * @Assert\NotNull()
     */
    public $file;

    /**
     * @var string|null
     *
     * @ApiProperty(iri="http://schema.org/contentUrl")
     * @Groups({"commentimage_object_read"})
     */
    public $contentUrl;

    /**
     * @var string|null
     * @ORM\Column(nullable=true)
     * @Groups({"projectimage_object_read","projectimage_object_create"})
     */
    private $url;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ImageDetails", mappedBy="image")
     * @Groups({"projectimage_object_read","projectimage_object_create"})
     *
     */
    private $imageDetails;

    public function __construct()
    {
        $this->imageDetails = new ArrayCollection();
    }


    public function getId()
    {
        return $this->id;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file): void
    {
        $this->file = $file;
    }

    public function getUrl()
    {
        return '/images/projectImages/'.$this->url;
    }
    /**
     * @return string|null
     */
    public function getContentUrl(): ?string
    {
        return $this->contentUrl;
    }

    /**
     * @param string|null $contentUrl
     */
    public function setContentUrl(?string $contentUrl): void
    {
        $this->contentUrl = $contentUrl;
    }
    public function setUrl($url): void
    {
        $this->url = $url;
    }

    public function __toString()
    {
        return $this->id . ':' . $this->url;
    }

    /**
     * @return Collection|ImageDetails[]
     */
    public function getImageDetails(): Collection
    {
        return $this->imageDetails;
    }

    public function addImageDetail(ImageDetails $imageDetail): self
    {
        if (!$this->imageDetails->contains($imageDetail)) {
            $this->imageDetails[] = $imageDetail;
            $imageDetail->addImage($this);
        }

        return $this;
    }

    public function removeImageDetail(ImageDetails $imageDetail): self
    {
        if ($this->imageDetails->contains($imageDetail)) {
            $this->imageDetails->removeElement($imageDetail);
            $imageDetail->removeImage($this);
        }

        return $this;
    }





}