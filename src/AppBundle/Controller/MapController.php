<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MapLayer;
use AppBundle\Entity\MapPointSet;
use AppBundle\Form\MapLayersType;
use AppBundle\ValueObject\MapLayersUpdate;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MapController extends Controller
{
    /**
     * @Route("/view")
     */
    public function viewAction()
    {
        $layers = new MapLayer();
        $layers->setPointSets([new MapPointSet()]);
        $form = $this->createForm(MapLayersType::class, new MapLayersUpdate([$layers]), [

        ]);
        return $this->render('AppBundle:Map:view.html.twig', array(
            'form'  => $form->createView()// ...
        ));
    }

}
