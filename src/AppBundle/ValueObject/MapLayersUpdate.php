<?php
/**
 * Created by PhpStorm.
 * User: jmac
 * Date: 12/28/15
 * Time: 2:17 PM
 */

namespace AppBundle\ValueObject;


use AppBundle\Entity\MapLayer;

class MapLayersUpdate
{
    /**
     * @var MapLayer[]
     */
    protected $mapLayers = [];

    /**
     * MapLayersUpdate constructor.
     * @param \AppBundle\Entity\MapLayer[] $mapLayers
     */
    public function __construct(array $mapLayers)
    {
        $this->mapLayers = $mapLayers;
    }

    /**
     * @return \AppBundle\Entity\MapLayer[]
     */
    public function getMapLayers()
    {
        return $this->mapLayers;
    }

    /**
     * @param \AppBundle\Entity\MapLayer[] $mapLayers
     */
    public function setMapLayers($mapLayers)
    {
        $this->mapLayers = $mapLayers;
    }


}