<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MapLayer
 *
 * @ORM\Table(name="map_layer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MapLayerRepository")
 */
class MapLayer
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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var guid
     *
     * @ORM\Column(name="hash", type="guid", unique=true)
     */
    private $hash;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="pointSets", type="object")
     */
    private $pointSets;


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
     * @return MapLayer
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
     * Set title
     *
     * @param string $title
     *
     * @return MapLayer
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set hash
     *
     * @param guid $hash
     *
     * @return MapLayer
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash
     *
     * @return guid
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set pointSets
     *
     * @param \stdClass $pointSets
     *
     * @return MapLayer
     */
    public function setPointSets(array $pointSets)
    {
        $this->pointSets = $pointSets;

        return $this;
    }

    /**
     * Get pointSets
     *
     * @return \stdClass
     */
    public function getPointSets()
    {
        return $this->pointSets;
    }
}

