<?php

namespace JuegoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Resistencia
 *
 * @ORM\Table(name="resistencia")
 * @ORM\Entity(repositoryClass="JuegoBundle\Repository\ResistenciaRepository")
 */
class Resistencia
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
     * @ORM\Column(name="Tiempo", type="integer")
     */
    private $tiempo;


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
     * Set tiempo
     *
     * @param int $tiempo
     *
     * @return Fuerza
     */
    public function setTiempo($tiempo)
    {
        $this->tiempo = $tiempo;

        return $this;
    }

    /**
     * Get tiempo
     *
     * @return int
     */
    public function getTiempo()
    {
        return $this->tiempo;
    }
}
