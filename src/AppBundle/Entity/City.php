<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * City
 *
 * @ORM\Table(name="city")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CityRepository")
 */
class City
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
     * @ORM\Column(name="name", type="string", length=80)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="costsToDate", type="float")
     */
    private $costsToDate;

    /**
     * @var int
     *
     * @ORM\Column(name="structuresRemaining", type="smallint")
     */
    private $structuresRemaining;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255, unique=true)
     */
    private $location;


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
     * @return City
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
     * Set costsToDate
     *
     * @param float $costsToDate
     *
     * @return City
     */
    public function setCostsToDate($costsToDate)
    {
        $this->costsToDate = $costsToDate;

        return $this;
    }

    /**
     * Get costsToDate
     *
     * @return float
     */
    public function getCostsToDate()
    {
        return $this->costsToDate;
    }

    /**
     * Set structuresRemaining
     *
     * @param integer $structuresRemaining
     *
     * @return City
     */
    public function setStructuresRemaining($structuresRemaining)
    {
        $this->structuresRemaining = $structuresRemaining;

        return $this;
    }

    /**
     * Get structuresRemaining
     *
     * @return int
     */
    public function getStructuresRemaining()
    {
        return $this->structuresRemaining;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return City
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }
}

