<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\StructureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: StructureRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection()
    ],
    normalizationContext: ['groups' => ['read:collection','read:Post']]

)]

class Structure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:collection'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:collection','read:structure'])]

    private ?string $structure_name = null;

    #[ORM\Column]
    #[Groups(['read:collection'])]
    private ?int $structure_phone = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:collection'])]
    private ?string $structure_address = null;

    #[ORM\Column]
    #[Groups(['read:collection'])]
    private ?int $structure_postal = null;

    #[ORM\Column]
    #[Groups(['read:collection'])]
    private ?bool $structure_active = null;

    #[ORM\ManyToOne(inversedBy: 'structures')]
    #[Groups(['read:collection'])]
    private ?Partner $structure_partner = null;

    #[ORM\ManyToMany(targetEntity: StructurePermission::class, mappedBy: 'structure_permission_associate')]
    #[Groups(['read:collection'])]
    private Collection $structurePermissions;

    public function __construct()
    {
        $this->structurePermissions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStructureName(): ?string
    {
        return $this->structure_name;
    }

    public function setStructureName(string $structure_name): self
    {
        $this->structure_name = $structure_name;

        return $this;
    }

    public function getStructurePhone(): ?int
    {
        return $this->structure_phone;
    }

    public function setStructurePhone(int $structure_phone): self
    {
        $this->structure_phone = $structure_phone;

        return $this;
    }

    public function getStructureAddress(): ?string
    {
        return $this->structure_address;
    }

    public function setStructureAddress(string $structure_address): self
    {
        $this->structure_address = $structure_address;

        return $this;
    }

    public function getStructurePostal(): ?int
    {
        return $this->structure_postal;
    }

    public function setStructurePostal(int $structure_postal): self
    {
        $this->structure_postal = $structure_postal;

        return $this;
    }

    public function isStructureActive(): ?bool
    {
        return $this->structure_active;
    }

    public function setStructureActive(bool $structure_active): self
    {
        $this->structure_active = $structure_active;

        return $this;
    }

    public function getStructurePartner(): ?Partner
    {
        return $this->structure_partner;
    }

    public function setStructurePartner(?Partner $structure_partner): self
    {
        $this->structure_partner = $structure_partner;

        return $this;
    }

    /**
     * @return Collection<int, StructurePermission>
     */
    public function getStructurePermissions(): Collection
    {
        return $this->structurePermissions;
    }

    public function addStructurePermission(StructurePermission $structurePermission): self
    {
        if (!$this->structurePermissions->contains($structurePermission)) {
            $this->structurePermissions->add($structurePermission);
            $structurePermission->addStructurePermissionAssociate($this);
        }

        return $this;
    }

    public function removeStructurePermission(StructurePermission $structurePermission): self
    {
        if ($this->structurePermissions->removeElement($structurePermission)) {
            $structurePermission->removeStructurePermissionAssociate($this);
        }

        return $this;
    }
    public function __toString()
    {
        return (string) $this->getStructureName();
    }
}
