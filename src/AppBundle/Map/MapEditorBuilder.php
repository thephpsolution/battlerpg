<?php
/**
 * Created by PhpStorm.
 * User: jmac
 * Date: 12/28/15
 * Time: 2:32 PM
 */

namespace AppBundle\Map;


use AppBundle\Entity\MapLayer;
use AppBundle\Entity\MapPointSet;
use AppBundle\Enum\MapLayerCategoryEnum;
use AppBundle\ValueObject\MapLayersUpdate;

class MapEditorBuilder
{
    public function buildForForm()
    {
        $layers = [];
        foreach (MapLayerCategoryEnum::getAll() as $constant => $title) {
            $layers[$constant] = (new MapLayer())
                ->setHash(uniqid('', true))
                ->setName($constant)
                ->setTitle($title)
            ;
            if ($constant === 'MOUNTAIN') {
                $layers[$constant]->setPointSets([
                    $pointSet = (new MapPointSet())
                        ->setTitle('First Mount')
                        ->setPoints(explode(',', '549,194,549,316,563,339,517,372,533,386,566,373,585,370,597,379,637,372,665,365,669,376,717,381,790,399,811,382,807,371,698,329,680,282,663,278,645,292,626,271,604,263,621,247,606,232,597,234,596,198,582,183,568,187'))
                ])
            ;
            $pointSet->setLayer($layers[$constant]);

            }
        }
        return new MapLayersUpdate($layers);
    }

}