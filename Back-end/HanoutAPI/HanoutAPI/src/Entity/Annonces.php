<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\AnnoncesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnnoncesRepository::class)
 */
class Annonces
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("annonces:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     * @Groups("annonces:read")
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=1024)
     * @Groups("annonces:read")
     */
    private $Description;

    /**
     * @ORM\Column(type="float")
     * @Groups("annonces:read")
     */
    private $Prix;

    /**
     * @ORM\Column(type="integer")
     * @Groups("annonces:read")
     */
    private $utilisateurId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("annonces:read")
     */
    private $acheteurId;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("annonces:read")
     */
    private $photo;


    /**
     * @ORM\ManyToOne(targetEntity=Utilisateurs::class)
     * @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")
     * @Groups("annonces:read")
     */
    private $vendeur;

    public function getVendeur(): string
    {
        return $this->vendeur->getPseudo();
    }

    public function setVendeur(?Utilisateurs $vendeur): self
    {
        $this->vendeur = $vendeur;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(float $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getUtilisateurId(): ?int
    {
        return $this->utilisateurId;
    }

    public function setUtilisateurId(int $utilisateurId): self
    {
        $this->utilisateurId = $utilisateurId;

        return $this;
    }

    public function getAcheteurId(): ?int
    {
        return $this->acheteurId;
    }

    public function setAcheteurId(int $acheteurId): self
    {
        $this->acheteurId = $acheteurId;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }
}
