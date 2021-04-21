<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="im2021_users", options={"comment":"Table des utilisateurs du site"})
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 */
class Users
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="pk")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30, name="identifiant", options={"comment":"sert de login (doit être unique)"}, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64, name="motdepasse", options={"comment":"mot de passe crypté : il faut une taille assez grande pour ne pas le tronquer"})
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=30, name="nom", options={"default"=null}, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=30, name="prenom", options={"default"=null}, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="date", name="anniversaire", options={"default"=null}, nullable=true)
     */
    private $birth;

    /**
     * @ORM\Column(type="smallint", options={"default"=0}, options={"comment":"type booléen"})
     */
    private $isadmin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = sha1($password);

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getBirth(): ?\DateTimeInterface
    {
        return $this->birth;
    }

    public function setBirth(?\DateTimeInterface $birth): self
    {
        $this->birth = $birth;

        return $this;
    }

    public function getIsAdmin(): ?int
    {
        return $this->isadmin;
    }

    public function setIsAdmin(int $isadmin): self
    {
        $this->isadmin = $isadmin;

        return $this;
    }
}

/*  Authors :
 *      - ANDRIANARIVONY Henintsoa
 *      - GOUBEAU Samuel
 */ 
