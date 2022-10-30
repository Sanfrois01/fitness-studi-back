<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\StructurePermissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: StructurePermissionRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection()
    ]
)]

class StructurePermission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:Post'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:Post'])]
    private ?string $structure_permission_name = null;

    #[ORM\Column]
    private ?bool $structure_permission_active = null;

    #[ORM\ManyToMany(targetEntity: Structure::class, inversedBy: 'structurePermissions')]
    private Collection $structure_permission_associate;

    public function __construct()
    {
        $this->structure_permission_associate = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStructurePermissionName(): ?string
    {
        return $this->structure_permission_name;
    }

    public function setStructurePermissionName(string $structure_permission_name): self
    {
        $this->structure_permission_name = $structure_permission_name;

        return $this;
    }

    public function isStructurePermissionActive(): ?bool
    {
        return $this->structure_permission_active;
    }

    public function setStructurePermissionActive(bool $structure_permission_active): self
    {
        $this->structure_permission_active = $structure_permission_active;

        return $this;
    }

    /**
     * @return Collection<int, Structure>
     */
    public function getStructurePermissionAssociate(): Collection
    {
        return $this->structure_permission_associate;
    }

    public function addStructurePermissionAssociate(Structure $structurePermissionAssociate): self
    {
        if (!$this->structure_permission_associate->contains($structurePermissionAssociate)) {
            $this->structure_permission_associate->add($structurePermissionAssociate);
        }

        return $this;
    }

    public function removeStructurePermissionAssociate(Structure $structurePermissionAssociate): self
    {
        $this->structure_permission_associate->removeElement($structurePermissionAssociate);

        return $this;
    }
    public function __toString()
    {
        return (string) $this->getStructurePermissionName();
    }
}
