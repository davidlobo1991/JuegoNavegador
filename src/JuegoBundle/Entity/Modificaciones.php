<?php

namespace JuegoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modificaciones
 *
 * @ORM\Table(name="modificaciones")
 * @ORM\Entity(repositoryClass="JuegoBundle\Repository\ModificacionesRepository")
 */
class Modificaciones
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
     * @ORM\Column(name="valor", type="string")
     */
    private $valor;

    /**
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $User;

    //public function __construct()
    //{
     //   $this->setFecha(new \DateTime());
    //}


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
     * Set valor
     *
     * @param string $valor
     *
     * @return Modificaciones
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set fecha
     *
     * @param \timestamp $fecha
     *
     * @return Modificaciones
     *
    public function setFecha(\timestamp $fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \timestamp
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Modificaciones
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Set user
     *
     * @param \JuegoBundle\Entity\User $user
     *
     * @return Modificaciones
     */
    public function setUser(\JuegoBundle\Entity\User $user = null)
    {
        $this->User = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \JuegoBundle\Entity\User
     */
    public function getUser()
    {
        return $this->User;
    }
}
