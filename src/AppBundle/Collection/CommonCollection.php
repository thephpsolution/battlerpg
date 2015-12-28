<?php
/**
 * Created by PhpStorm.
 * User: jmac
 * Date: 12/28/15
 * Time: 1:36 PM
 */

namespace AppBundle\Collection;


use Doctrine\Common\Collections\ArrayCollection;

class CommonCollection extends ArrayCollection
{
    protected $type = \stdClass::class;

    public function __construct(array $elements, $type = null)
    {
        parent::__construct($elements);
        $this->type = $type || !$this->count() ? $type : get_class($this[0]);
    }


}