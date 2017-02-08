<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pedidos
 *
 * @ORM\Table(name="pedidos")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PedidosRepository")
 */
class Pedidos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="cantidad", type="integer")
     */
    private $cantidad;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float")
     */
    private $total;
    
    /*RELACIONES*/
    
    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="CliPed", inversedBy="Pedidos")
     * @ORM\JoinColumn(name="cabpedFk", referencedColumnName="id")
     */
    private $cabpedFk;
    
    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Platos", inversedBy="Pedidos")
     * @ORM\JoinColumn(name="plapedFk", referencedColumnName="id")
     */
    private $plapedFk;
    
    


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return Pedidos
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return int
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set total
     *
     * @param float $total
     *
     * @return Pedidos
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set cabpedFk
     *
     * @param \AppBundle\Entity\CliPed $cabpedFk
     *
     * @return Pedidos
     */
    public function setCabpedFk(\AppBundle\Entity\CliPed $cabpedFk = null)
    {
        $this->cabpedFk = $cabpedFk;

        return $this;
    }

    /**
     * Get cabpedFk
     *
     * @return \AppBundle\Entity\CliPed
     */
    public function getCabpedFk()
    {
        return $this->cabpedFk;
    }

    /**
     * Set plapedFk
     *
     * @param \AppBundle\Entity\Platos $plapedFk
     *
     * @return Pedidos
     */
    public function setPlapedFk(\AppBundle\Entity\Platos $plapedFk = null)
    {
        $this->plapedFk = $plapedFk;

        return $this;
    }

    /**
     * Get plapedFk
     *
     * @return \AppBundle\Entity\Platos
     */
    public function getPlapedFk()
    {
        return $this->plapedFk;
    }
}
