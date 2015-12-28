<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MapLayer;
use AppBundle\Entity\MapPointSet;
use AppBundle\Form\MapLayersType;
use AppBundle\Map\MapEditorBuilder;
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
        $form = $this->createForm(MapLayersType::class, $layers = (new MapEditorBuilder())->buildForForm(), [

        ]);
        return $this->render('AppBundle:Map:view.html.twig', array(
            'form'  => $form->createView(),// ...
            'update' => $layers
        ));
    }

}
