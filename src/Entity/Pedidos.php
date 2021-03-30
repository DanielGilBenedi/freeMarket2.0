<?php

namespace App\Entity;

use App\Repository\PedidosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PedidosRepository::class)
 */
class Pedidos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $num_pedido;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cod_pedido;

    /**
     * @ORM\Column(type="float")
     */
    private $precio;

    /**
     * @ORM\Column(type="array")
     */
    private $array_productos = [];

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="marcas")
     */
    private $id_cliente;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(?\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getNumPedido(): ?string
    {
        return $this->num_pedido;
    }

    public function setNumPedido(string $num_pedido): self
    {
        $this->num_pedido = $num_pedido;

        return $this;
    }

    public function getCodPedido(): ?string
    {
        return $this->cod_pedido;
    }

    public function setCodPedido(string $cod_pedido): self
    {
        $this->cod_pedido = $cod_pedido;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getArrayProductos(): ?array
    {
        return $this->array_productos;
    }

    public function setArrayProductos(array $array_productos): self
    {
        $this->array_productos = $array_productos;

        return $this;
    }

    public function getIdCliente(): ?User
    {
        return $this->id_cliente;
    }

    public function setIdCliente(?User $id_cliente): self
    {
        $this->id_cliente = $id_cliente;

        return $this;
    }
}
