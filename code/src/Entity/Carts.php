<?php

namespace App\Entity;

use App\Repository\CartsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="im2021_carts", options={"comment":"Table des paniers"})
 * @ORM\Entity(repositoryClass=CartsRepository::class)
 */
class Carts
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class)
     * @ORM\JoinColumn(referencedColumnName="pk", nullable=false)
     */
    private $id_user;

    /**
     * @ORM\ManyToOne(targetEntity=Products::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_product;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?Users
    {
        return $this->id_user;
    }

    public function setIdUser(?Users $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getIdProduct(): ?Products
    {
        return $this->id_product;
    }

    public function setIdProduct(?Products $id_product): self
    {
        $this->id_product = $id_product;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
