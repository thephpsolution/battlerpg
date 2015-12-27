<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Yields
 *
 * @ORM\Table(name="yields")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\YieldsRepository")
 */
class Yields
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
     * @ORM\Column(name="tick", type="integer")
     */
    private $tick;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="city", type="object")
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="resource", type="string", length=100)
     */
    private $resource;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;


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
     * Set tick
     *
     * @param integer $tick
     *
     * @return Yields
     */
    public function setTick($tick)
    {
        $this->tick = $tick;

        return $this;
    }

    /**
     * Get tick
     *
     * @return int
     */
    public function getTick()
    {
        return $this->tick;
    }

    /**
     * Set city
     *
     * @param \stdClass $city
     *
     * @return Yields
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \stdClass
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set resource
     *
     * @param string $resource
     *
     * @return Yields
     */
    public function setResource($resource)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get resource
     *
     * @return string
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return Yields
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }
}

