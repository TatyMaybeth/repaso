<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CliPed
 *
 * @ORM\Table(name="cliped")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CliPedRepository")
 */
class CliPed
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /*RELACIONES*/
    
    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Clientes", inversedBy="CliPed")
     * @ORM\JoinColumn(name="clienteFk", referencedColumnName="id")
     */
    private $clienteFk;
    
    /**
     * @ORM\OneToMany(targetEntity="Pedidos", mappedBy="cabpedFk")
     */
    private $pedido;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pedido = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set clienteFk
     *
     * @param \AppBundle\Entity\Clientes $clienteFk
     *
     * @return CliPed
     */
    public function setClienteFk(\AppBundle\Entity\Clientes $clienteFk = null)
    {
        $this->clienteFk = $clienteFk;

        return $this;
    }

    /**
     * Get clienteFk
     *
     * @return \AppBundle\Entity\Clientes
     */
    public function getClienteFk()
    {
        return $this->clienteFk;
    }

    /**
     * Add pedido
     *
     * @param \AppBundle\Entity\Pedidos $pedido
     *
     * @return CliPed
     */
    public function addPedido(\AppBundle\Entity\Pedidos $pedido)
    {
        $this->pedido[] = $pedido;

        return $this;
    }

    /**
     * Remove pedido
     *
     * @param \AppBundle\Entity\Pedidos $pedido
     */
    public function removePedido(\AppBundle\Entity\Pedidos $pedido)
    {
        $this->pedido->removeElement($pedido);
    }

    /**
     * Get pedido
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPedido()
    {
        return $this->pedido;
    }
}
