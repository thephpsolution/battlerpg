<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MapPointSet
 *
 * @ORM\Table(name="map_point_set")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MapPointSetRepository")
 */
class MapPointSet
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
     * @var \stdClass
     *
     * @ORM\Column(name="layer", type="object")
     */
    private $layer;

    /**
     * @var array
     *
     * @ORM\Column(name="points", type="array")
     */
    private $points;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;


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
     * Set layer
     *
     * @param \stdClass $layer
     *
     * @return MapPointSet
     */
    public function setLayer($layer)
    {
        $this->layer = $layer;

        return $this;
    }

    /**
     * Get layer
     *
     * @return \stdClass
     */
    public function getLayer()
    {
        return $this->layer;
    }

    /**
     * Set points
     *
     * @param array $points
     *
     * @return MapPointSet
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return array
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return MapPointSet
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
}

