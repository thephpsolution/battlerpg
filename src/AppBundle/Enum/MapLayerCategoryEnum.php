<?php
/**
 * Created by PhpStorm.
 * User: jmac
 * Date: 12/28/15
 * Time: 2:34 PM
 */

namespace AppBundle\Enum;


class MapLayerCategoryEnum
{
    const MOUNTAIN = 'Mountain';
    const WATER = 'Water';
    const BOUNDARY = 'Boundary';
    const TREES = 'Tree';
    const PATH = 'Path';
    const FIELD = 'Field';

    protected $enum = '';

    /**
     * MapLayerCategoryEnum constructor.
     * @param string $enum
     */
    public function __construct($enum)
    {
        $this->enum = $enum;
    }

    public static function getAll()
    {
        $class = new \ReflectionClass(__CLASS__);
        return $class->getConstants();
    }
}