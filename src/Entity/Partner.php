<?php

namespace App\Entity;

use ApiPlatform\Metadata\GetCollection;
use App\Repository\PartnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PartnerRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection()
    ],
    normalizationContext: ['groups' => ['read:structure']]
)]
class Partner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:structure'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:Post', 'read:structure'])]

    private ?string $partner_name = null;

    #[ORM\Column]
    #[Groups(['read:structure'])]

    private ?int $partner_phone = null;

    #[ORM\Column]
    #[Groups(['read:structure'])]

    private ?bool $partner_active = null;

    #[ORM\OneToMany(mappedBy: 'structure_partner', targetEntity: Structure::class)]
    #[Groups(['read:structure'])]
    private Collection $structures;

    public function __construct()
    {
        $this->structures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPartnerName(): ?string
    {
        return $this->partner_name;
    }

    public function setPartnerName(string $partner_name): self
    {
        $this->partner_name = $partner_name;

        return $this;
    }

    public function getPartnerPhone(): ?int
    {
        return $this->partner_phone;
    }

    public function setPartnerPhone(int $partner_phone): self
    {
        $this->partner_phone = $partner_phone;

        return $this;
    }

    public function isPartnerActive(): ?bool
    {
        return $this->partner_active;
    }

    public function setPartnerActive(bool $partner_active): self
    {
        $this->partner_active = $partner_active;

        return $this;
    }

    /**
     * @return Collection<int, Structure>
     */
    public function getStructures(): Collection
    {
        return $this->structures;
    }

    public function addStructure(Structure $structure): self
    {
        if (!$this->structures->contains($structure)) {
            $this->structures->add($structure);
            $structure->setStructurePartner($this);
        }

        return $this;
    }

    public function removeStructure(Structure $structure): self
    {
        if ($this->structures->removeElement($structure)) {
            // set the owning side to null (unless already changed)
            if ($structure->getStructurePartner() === $this) {
                $structure->setStructurePartner(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return (string) $this->getPartnerName();
    }
}
