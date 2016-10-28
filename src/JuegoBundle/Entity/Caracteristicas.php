<?php

namespace JuegoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Caracteristicas
 *
 * @ORM\Table(name="caracteristicas")
 * @ORM\Entity(repositoryClass="JuegoBundle\Repository\CaracteristicasRepository")
 */
class Caracteristicas
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
     * @ORM\ManyToOne(targetEntity="Fuerza")
     * @ORM\JoinColumn(name="fuerza", referencedColumnName="id")
     */
    private $fuerza;

    /**
     * @ORM\ManyToOne(targetEntity="Resistencia")
     * @ORM\JoinColumn(name="resistencia", referencedColumnName="id" )
     */

    private $resistencia;

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
     * Set fuerza
     *
     * @param integer $fuerza
     *
     * @return Caracteristicas
     */
    public function setFuerza($fuerza)
    {
        $this->fuerza = $fuerza;

        return $this;
    }

    /**
     * Get fuerza
     *
     * @return int
     */
    public function getFuerza()
    {
        return $this->fuerza;
    }

    /**
     * Set resistencia
     *
     * @param integer $resistencia
     *
     * @return Caracteristicas
     */
    public function setResistencia($resistencia)
    {
        $this->resistencia = $resistencia;

        return $this;
    }

    /**
     * Get resistencia
     *
     * @return int
     */
    public function getResistencia()
    {
        return $this->resistencia;
    }


    /**
     * Set user
     *
     * @param \JuegoBundle\Entity\User $user
     *
     * @return Caracteristicas
     */
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fuerza = new \Doctrine\Common\Collections\ArrayCollection();
        $this->resistencia = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add fuerza
     *
     * @param \JuegoBundle\Entity\Fuerza $fuerza
     *
     * @return Caracteristicas
     */
    public function addFuerza(\JuegoBundle\Entity\Fuerza $fuerza)
    {
        $this->fuerza[] = $fuerza;

        return $this;
    }

    /**
     * Remove fuerza
     *
     * @param \JuegoBundle\Entity\Fuerza $fuerza
     */
    public function removeFuerza(\JuegoBundle\Entity\Fuerza $fuerza)
    {
        $this->fuerza->removeElement($fuerza);
    }

    /**
     * Add resistencium
     *
     * @param \JuegoBundle\Entity\Resistencia $resistencium
     *
     * @return Caracteristicas
     */
    public function addResistencium(\JuegoBundle\Entity\Resistencia $resistencium)
    {
        $this->resistencia[] = $resistencium;

        return $this;
    }

    /**
     * Remove resistencium
     *
     * @param \JuegoBundle\Entity\Resistencia $resistencium
     */
    public function removeResistencium(\JuegoBundle\Entity\Resistencia $resistencium)
    {
        $this->resistencia->removeElement($resistencium);
    }
}
