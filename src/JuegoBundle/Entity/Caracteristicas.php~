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
     * @var int
     *
     * @ORM\Column(name="Fuerza", type="integer")
     */
    private $fuerza;

    /**
     * @var int
     *
     * @ORM\Column(name="Resistencia", type="integer")
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
}
