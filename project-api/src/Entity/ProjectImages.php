<?php


namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Controller\CreateProjectImageAction;

/**
 * @ORM\Entity()
 * @Vich\Uploadable()
 * @ApiResource(
 *     attributes={
 *         "order"={"id": "ASC"},
 *         "formats"={"json", "jsonld", "form"={"multipart/form-data"}}
 *     },
 *     collectionOperations={
 *         "get",
 *         "post"={
 *             "method"="POST",
 *             "path"="/images/projectImages",
 *             "controller"=CreateProjectImageAction::class,
 *             "defaults"={"_api_receive"=false}
 *         }
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
     */
    private $id;

    /**
     * @Vich\UploadableField(mapping="projectImages", fileNameProperty="url")
     * @Assert\NotNull()
     */
    private $file;

    /**
     * @ORM\Column(nullable=true)
     * @Groups({"get_Projects_under_ministry","get_projects"})
     */
    private $url;

    /**
     * @var phase
     * @ORM\Column(nullable=true, type="string", length=10)
     * @Groups({"get_Projects_under_ministry"})
     */
    private $phase;

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
        return '/images/projectImages/' . $this->url;
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
     * @return phase
     */
    public function getPhase(): ?string
    {
        return $this->phase;
    }

    /**
     * @param phase $phase
     */
    public function setPhase(phase $phase): void
    {
        $this->phase = $phase;
    }

}