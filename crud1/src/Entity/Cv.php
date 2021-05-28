<?php

namespace App\Entity;

use App\Repository\CvRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CvRepository::class)
 */
class Cv
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;


    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 1,
     *      max = 12,
     *
     * )
     */

    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     *
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer")
     *
     */
    private $codepostale;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="date")
     *
     */
    private $datedenaissance;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $lieu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $etatcivil;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $formation;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $etablif;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $stage;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $etablis;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $experience;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tablie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $centredinteret;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $longtitude;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $altitude;

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo): void
    {
        $this->photo = $photo;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodepostale(): ?int
    {
        return $this->codepostale;
    }

    public function setCodepostale(int $codepostale): self
    {
        $this->codepostale = $codepostale;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getDatedenaissance(): ?\DateTimeInterface
    {
        return $this->datedenaissance;
    }

    public function setDatedenaissance(\DateTimeInterface $datedenaissance): self
    {
        $this->datedenaissance = $datedenaissance;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getEtatcivil(): ?string
    {
        return $this->etatcivil;
    }

    public function setEtatcivil(string $etatcivil): self
    {
        $this->etatcivil = $etatcivil;

        return $this;
    }

    public function getFormation(): ?string
    {
        return $this->formation;
    }

    public function setFormation(string $formation): self
    {
        $this->formation = $formation;

        return $this;
    }

    public function getEtablif(): ?string
    {
        return $this->etablif;
    }

    public function setEtablif(string $etablif): self
    {
        $this->etablif = $etablif;

        return $this;
    }

    public function getStage(): ?string
    {
        return $this->stage;
    }

    public function setStage(string $stage): self
    {
        $this->stage = $stage;

        return $this;
    }

    public function getEtablis(): ?string
    {
        return $this->etablis;
    }

    public function setEtablis(string $etablis): self
    {
        $this->etablis = $etablis;

        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(string $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getTablie(): ?string
    {
        return $this->tablie;
    }

    public function setTablie(string $tablie): self
    {
        $this->tablie = $tablie;

        return $this;
    }

    public function getCentredinteret(): ?string
    {
        return $this->centredinteret;
    }

    public function setCentredinteret(string $centredinteret): self
    {
        $this->centredinteret = $centredinteret;

        return $this;
    }


    public function getLongtitude()
    {
        return $this->longtitude;
    }


    public function setLongtitude($longtitude): void
    {
        $this->longtitude = $longtitude;
    }


    public function getAltitude()
    {
        return $this->altitude;
    }


    public function setAltitude($altitude): void
    {
        $this->altitude = $altitude;
    }

}
