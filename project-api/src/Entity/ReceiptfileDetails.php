<?php


namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *       normalizationContext={
 *         "groups"={"projectPaymentReceiptfile_object_read"}
 *     },

 *
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ReceiptfileDetailsRepository")
 */
class ReceiptfileDetails
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"projectPaymentReceiptfile_object_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"projectPaymentReceiptfile_object_read"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"projectPaymentReceiptfile_object_read"})
     */
    private $phase;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ProjectPaymentReceiptFiles", inversedBy="fileDetails")
     *
     * @ApiSubresource()
     */
    private $receiptFile;

    public function __construct()
    {
        $this->receiptFile = new ArrayCollection();
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
     * @return Collection|ProjectAgreementFile[]
     */
    public function getReceiptFile(): Collection
    {
        return $this->receiptFile;
    }

    public function addReceiptFile(ProjectPaymentReceiptFiles $receiptFile): self
    {
        if (!$this->receiptFile->contains($receiptFile)) {
            $this->receiptFile[] = $receiptFile;
        }

        return $this;
    }

    public function removeReceiptFile(ProjectPaymentReceiptFiles $receiptFile): self
    {
        if ($this->receiptFile->contains($receiptFile)) {
            $this->receiptFile->removeElement($receiptFile);
        }

        return $this;
    }

}