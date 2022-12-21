<?php

namespace App\Entity;

use Assert\File;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\OsobyRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @ORM\Entity(repositoryClass=OsobyRepository::class)
 * @ApiResource (paginationEnabled = false, order = {"nazwisko", "imie"}, collectionOperations = {"get" = {"normalization_context" = {"groups" = "osoby:list"}}}, itemOperations = {"get" = { "normalization_context" = {"groups" = "osoby:item"} }})
 */

class Osoby implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"osoby:list"}, {"osoby:item"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"osoby:list"}, {"osoby:item"})
     */
    private $imie;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"osoby:list"}, {"osoby:item"})
     */
    private $nazwisko;

    /**
     * @ORM\Column(type="string", length=11)
     * @Assert\Length(
     *      min = 11,
     *      max = 11,
     *      exactMessage = "Pesel powinien mieć 11 znaków",
     *)
     * @Groups({"osoby:item"})
     */
    private $pesel;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Groups({"osoby:item"})
     */
    private $nip;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"osoby:item"})
     */
    private $adres;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email(
     *     message = "Podaj prawidłowy adres email"
     * )
     * @Groups({"osoby:item"})
     */
    private $email;

    private $plainPassword;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $haslo;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"osoby:item"})
     */
    private $opis;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"osoby:item"})
     */
    private $zainteresowania;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"osoby:item"})
     */
    private $umiejetnosci;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"osoby:item"})
     */
    private $doswiadczenie;

    /**
     * @ORM\Column(type="date")
     * @Groups({"osoby:item"})
     */
    private $data_urodzenia;

    /**
     * @ORM\Column(type="date")
     * @Groups({"osoby:item"})
     */
    private $data_rejestracji;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"osoby:item"})
     */
    private $data_aktualizacji_wpisu;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"osoby:item"})
     */
    private $ocena;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Please upload a valid PDF",
     * )
     * @Groups({"osoby:item"})
     */
    private $cv;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImie(): ?string
    {
        return $this->imie;
    }

    public function setImie(string $imie): self
    {
        $this->imie = $imie;

        return $this;
    }

    public function getNazwisko(): ?string
    {
        return $this->nazwisko;
    }

    public function setNazwisko(string $nazwisko): self
    {
        $this->nazwisko = $nazwisko;

        return $this;
    }

    public function getPesel(): ?string
    {
        return $this->pesel;
    }

    public function setPesel(string $pesel): self
    {
        $this->pesel = $pesel;

        return $this;
    }

    public function getNip(): ?string
    {
        return $this->nip;
    }

    public function setNip(?string $nip): self
    {
        $this->nip = $nip;

        return $this;
    }

    public function getAdres(): ?string
    {
        return $this->adres;
    }

    public function setAdres(?string $adres): self
    {
        $this->adres = $adres;

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

    public function getHaslo(): ?string
    {
        return $this->haslo;
    }

    public function setHaslo(string $haslo): self
    {
        $this->haslo = $haslo;

        return $this;
    }

    public function getOpis(): ?string
    {
        return $this->opis;
    }

    public function setOpis(?string $opis): self
    {
        $this->opis = $opis;

        return $this;
    }

    public function getZainteresowania(): ?string
    {
        return $this->zainteresowania;
    }

    public function setZainteresowania(?string $zainteresowania): self
    {
        $this->zainteresowania = $zainteresowania;

        return $this;
    }

    public function getUmiejetnosci(): ?string
    {
        return $this->umiejetnosci;
    }

    public function setUmiejetnosci(?string $umiejetnosci): self
    {
        $this->umiejetnosci = $umiejetnosci;

        return $this;
    }

    public function getDoswiadczenie(): ?string
    {
        return $this->doswiadczenie;
    }

    public function setDoswiadczenie(?string $doswiadczenie): self
    {
        $this->doswiadczenie = $doswiadczenie;

        return $this;
    }

    public function getDataUrodzenia(): ?\DateTimeInterface
    {
        return $this->data_urodzenia;
    }

    public function setDataUrodzenia(\DateTimeInterface $data_urodzenia): self
    {
        $this->data_urodzenia = $data_urodzenia;

        return $this;
    }

    public function getDataRejestracji(): ?\DateTimeInterface
    {
        return $this->data_rejestracji;
    }

    public function setDataRejestracji(\DateTimeInterface $data_rejestracji): self
    {
        $this->data_rejestracji = $data_rejestracji;

        return $this;
    }

    public function getDataAktualizacjiWpisu(): ?\DateTimeInterface
    {
        return $this->data_aktualizacji_wpisu;
    }

    public function setDataAktualizacjiWpisu(\DateTimeInterface $data_aktualizacji_wpisu): self
    {
        $this->data_aktualizacji_wpisu = $data_aktualizacji_wpisu;

        return $this;
    }

    public function getOcena(): ?int
    {
        return $this->ocena;
    }

    public function setOcena(string $ocena): self
    {
        $this->ocena = $ocena;

        return $this;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(?string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

        /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    public function eraseCredentials()
    {
        $this->plainPassword = '';
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFullName()
    {
        return $this->imie . ' ' . $this->nazwisko;
    }

}
