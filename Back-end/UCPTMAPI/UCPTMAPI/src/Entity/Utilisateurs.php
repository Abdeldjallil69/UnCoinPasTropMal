<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\UtilisateursRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UtilisateursRepository::class)
 */
class Utilisateurs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("utilisateurs:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups("utilisateurs:read")
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups("utilisateurs:read")
     */
    private $email;

    /**
     * @ORM\Column(type="date_immutable")
     * @Groups("utilisateurs:read")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups("utilisateurs:read")
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeImmutable
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeImmutable $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
