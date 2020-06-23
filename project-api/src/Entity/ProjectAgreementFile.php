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
use App\Controller\CreateProjectAgreementFileAction;
/**
 * @ORM\Entity()
 * @Vich\Uploadable()
 * @ApiResource(
 *      iri="http://schema.org/ProjectAgreementFile",
 *  normalizationContext={
 *         "groups"={"projectAgreementfile_object_read"}
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
 *             "validation_groups"={"Default", "projectAgreementfile_object_create"},
 *             "deserialize"=false,
 *             "controller"=CreateProjectAgreementFileAction::class,
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
class ProjectAgreementFile
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"projectAgreementfile_object_read","projectAgreementfile_object_create"})
     */
    private $id;

    /**
     *
     * @Vich\UploadableField(mapping="agreementFiles", fileNameProperty="url")
     * @Assert\NotNull()
     */
    public $file;

    /**
     * @var string|null
     *
     * @ApiProperty(iri="http://schema.org/contentUrl")
     * @Groups({"projectAgreementfile_object_read"})
     */
    public $contentUrl;

    /**
     * @var string|null
     * @ORM\Column(nullable=true)
     * @Groups({"get_Projects_under_ministry","get_projects","projectAgreementfile_object_read","projectAgreementfile_object_create"})
     */
    private $url;



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
        return '/files/project-agreements/'.$this->url;
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

}