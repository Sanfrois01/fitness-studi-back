<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\PermissionRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;


#[ORM\Entity(repositoryClass: PermissionRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection()
    ]
)]

class Permission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $permission_name = null;

    #[ORM\Column]
    private ?bool $permission_active = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPermissionName(): ?string
    {
        return $this->permission_name;
    }

    public function setPermissionName(string $permission_name): self
    {
        $this->permission_name = $permission_name;

        return $this;
    }

    public function isPermissionActive(): ?bool
    {
        return $this->permission_active;
    }

    public function setPermissionActive(bool $permission_active): self
    {
        $this->permission_active = $permission_active;

        return $this;
    }
}
