<?php
/**
 * Created by PhpStorm.
 * User: jmac
 * Date: 12/28/15
 * Time: 1:39 PM
 */

namespace AppBundle\Collection;


use AppBundle\Entity\MapLayer;
use AppBundle\Entity\MapPointSet;

class MapPointSetCollection extends CommonCollection
{
    public function __construct(array $elements, $type)
    {
        parent::__construct($elements, $type);
        $this->type = MapPointSet::class;
    }


}