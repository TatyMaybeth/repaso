<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Materias
 *
 * @ORM\Table(name="materias")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MateriasRepository")
 */
class Materias
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="creditos", type="string", length=10)
     */
    private $creditos;
    
    /*RELACIONES*/
    /**
     * @ORM\OneToMany(targetEntity="Estudiante", mappedBy="estmatFk")
     */
    private $estudiante;

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
     * Set name
     *
     * @param string $name
     *
     * @return Materias
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set creditos
     *
     * @param string $creditos
     *
     * @return Materias
     */
    public function setCreditos($creditos)
    {
        $this->creditos = $creditos;

        return $this;
    }

    /**
     * Get creditos
     *
     * @return string
     */
    public function getCreditos()
    {
        return $this->creditos;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->estudiante = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add estudiante
     *
     * @param \AppBundle\Entity\Estudiante $estudiante
     *
     * @return Materias
     */
    public function addEstudiante(\AppBundle\Entity\Estudiante $estudiante)
    {
        $this->estudiante[] = $estudiante;

        return $this;
    }

    /**
     * Remove estudiante
     *
     * @param \AppBundle\Entity\Estudiante $estudiante
     */
    public function removeEstudiante(\AppBundle\Entity\Estudiante $estudiante)
    {
        $this->estudiante->removeElement($estudiante);
    }

    /**
     * Get estudiante
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEstudiante()
    {
        return $this->estudiante;
    }
}
