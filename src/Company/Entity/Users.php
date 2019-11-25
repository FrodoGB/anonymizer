<?php

namespace App\VacationClub\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users", indexes={@ORM\Index(name="id_lang", columns={"id_lang"})})
 * @ORM\Entity
 */
class Users
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=250, nullable=false)
     */
    private $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=250, nullable=false)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_login", type="datetime", nullable=false, options={"comment"="and last activity"})
     */
    private $lastLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="type_user", type="string", length=100, nullable=false)
     */
    private $typeUser;

    /**
     * @var int
     *
     * @ORM\Column(name="id_lang", type="integer", nullable=false)
     */
    private $idLang;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active;

    /**
     * @var string
     *
     * @ORM\Column(name="session", type="string", length=40, nullable=false)
     */
    private $session;

    /**
     * @var string
     *
     * @ORM\Column(name="activate_code", type="string", length=15, nullable=false)
     */
    private $activateCode;

    /**
     * @var int
     *
     * @ORM\Column(name="role", type="integer", nullable=false, options={"comment"="old role id, it will deleted"})
     */
    private $role;

    /**
     * @var int
     *
     * @ORM\Column(name="subtype", type="integer", nullable=false, options={"default"="1","comment"="1 - gosc, 2 - wlasciciel i gosc"})
     */
    private $subtype = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="haslo2", type="string", length=250, nullable=false)
     */
    private $haslo2;

    /**
     * @var int
     *
     * @ORM\Column(name="role_id", type="integer", nullable=false, options={"comment"="new relation to user roles"})
     */
    private $roleId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="client_status", type="string", length=20, nullable=true, options={"comment"="Only for clients-hoteliers. Otherwise always null"})
     */
    private $clientStatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="password_changed_at", type="datetime", nullable=false)
     */
    private $passwordChangedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var string|null
     *
     * @ORM\Column(name="source", type="string", length=15, nullable=true)
     */
    private $source;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

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

    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->lastLogin;
    }

    public function setLastLogin(\DateTimeInterface $lastLogin): self
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    public function getTypeUser(): ?string
    {
        return $this->typeUser;
    }

    public function setTypeUser(string $typeUser): self
    {
        $this->typeUser = $typeUser;

        return $this;
    }

    public function getIdLang(): ?int
    {
        return $this->idLang;
    }

    public function setIdLang(int $idLang): self
    {
        $this->idLang = $idLang;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getSession(): ?string
    {
        return $this->session;
    }

    public function setSession(string $session): self
    {
        $this->session = $session;

        return $this;
    }

    public function getActivateCode(): ?string
    {
        return $this->activateCode;
    }

    public function setActivateCode(string $activateCode): self
    {
        $this->activateCode = $activateCode;

        return $this;
    }

    public function getRole(): ?int
    {
        return $this->role;
    }

    public function setRole(int $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getSubtype(): ?int
    {
        return $this->subtype;
    }

    public function setSubtype(int $subtype): self
    {
        $this->subtype = $subtype;

        return $this;
    }

    public function getHaslo2(): ?string
    {
        return $this->haslo2;
    }

    public function setHaslo2(string $haslo2): self
    {
        $this->haslo2 = $haslo2;

        return $this;
    }

    public function getRoleId(): ?int
    {
        return $this->roleId;
    }

    public function setRoleId(int $roleId): self
    {
        $this->roleId = $roleId;

        return $this;
    }

    public function getClientStatus(): ?string
    {
        return $this->clientStatus;
    }

    public function setClientStatus(?string $clientStatus): self
    {
        $this->clientStatus = $clientStatus;

        return $this;
    }

    public function getPasswordChangedAt(): ?\DateTimeInterface
    {
        return $this->passwordChangedAt;
    }

    public function setPasswordChangedAt(\DateTimeInterface $passwordChangedAt): self
    {
        $this->passwordChangedAt = $passwordChangedAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(?string $source): self
    {
        $this->source = $source;

        return $this;
    }


}
