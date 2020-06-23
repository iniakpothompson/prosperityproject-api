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
use App\Controller\CreateReceiptsAction;
/**
 * @ORM\Entity()
 * @Vich\Uploadable()
 * @ApiResource(
 *      iri="http://schema.org/ProjectPaymmentReceiptFile",
 *  normalizationContext={
 *         "groups"={"projectPaymentReceiptfile_object_read"}
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
 *                               "api_receiptfile_details_receipt_files_get_subresource"={
 *                                      "normalizationContext"={"groups"={"projectPaymentReceiptfile_object_read"}}
 *                          },
 *         "get",
 *         "post"={
 *             "validation_groups"={"Default", "projectPaymentReceiptfile_object_create"},
 *             "deserialize"=false,
 *             "controller"=CreateReceiptsAction::class,
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
class ProjectPaymentReceiptFiles
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"projectPaymentReceiptfile_object_read","projectPaymentReceiptfile_object_create"})
     */
    private $id;

    /**
     *
     * @Vich\UploadableField(mapping="receiptFiles", fileNameProperty="url")
     * @Assert\NotNull()
     */
    public $file;

    /**
     * @var string|null
     *
     * @ApiProperty(iri="http://schema.org/contentUrl")
     * @Groups({"projectPaymentReceiptfile_object_read"})
     */
    public $contentUrl;

    /**
     * @var string|null
     * @ORM\Column(nullable=true)
     * @Groups({"projectPaymentReceiptfile_object_read","projectPaymentReceiptfile_object_create"})
     */
    private $url;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ReceiptfileDetails", mappedBy="receiptFile")
     * @Groups({"projectPaymentReceiptfile_object_read","projectPaymentReceiptfile_object_create"})
     */
    private $fileDetails;


    public function __construct()
    {
        $this->fileDetails = new ArrayCollection();
        $this->projects = new ArrayCollection();
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
        return '/files/receipts/'.$this->url;
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
     * @return Collection|ReceiptfileDetails[]
     */
    public function getFileDetails(): Collection
    {
        return $this->fileDetails;
    }

    public function addFileDetails(ReceiptfileDetailsDetails $fileDetails): self
    {
        if (!$this->fileDetails->contains($fileDetails)) {
            $this->fileDetails[] = $fileDetails;
            $fileDetails->addReceiptFile($this);
        }

        return $this;
    }

    public function removeFileDetail(ReceiptfileDetails $fileDetails): self
    {
        if ($this->fileDetails->contains($fileDetails)) {
            $this->fileDetails->removeElement($fileDetails);
            $fileDetails->removeReceiptFile($this);
        }

        return $this;
    }

    public function addFileDetail(ReceiptfileDetails $fileDetail): self
    {
        if (!$this->fileDetails->contains($fileDetail)) {
            $this->fileDetails[] = $fileDetail;
            $fileDetail->addReceiptFile($this);
        }

        return $this;
    }


}