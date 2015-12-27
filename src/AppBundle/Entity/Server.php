<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Server
 *
 * @ORM\Table(name="server")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ServerRepository")
 */
class Server
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
     * @ORM\Column(name="name", type="string", length=60, unique=true)
     */
    private $name;

    /**
     * @var array
     *
     * @ORM\Column(name="planets", type="array")
     */
    private $planets;


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
     * @return Server
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
     * Set planets
     *
     * @param array $planets
     *
     * @return Server
     */
    public function setPlanets($planets)
    {
        $this->planets = $planets;

        return $this;
    }

    /**
     * Get planets
     *
     * @return array
     */
    public function getPlanets()
    {
        return $this->planets;
    }
}

