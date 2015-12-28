<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MapLayer;
use AppBundle\Entity\MapPointSet;
use AppBundle\Form\MapLayersType;
use AppBundle\Map\MapEditorBuilder;
use AppBundle\ValueObject\MapLayersUpdate;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class MapController extends Controller
{
    private function getForm($layers = null)
    {
        return $this->createForm(MapLayersType::class, $layers ?: (new MapEditorBuilder())->buildForForm(), [
            'action' => $this->generateUrl('update_map')
        ]);
    }
    /**
     * @Route("/map/view", name="view_map")
     */
    public function viewAction()
    {
        $layers = (new MapEditorBuilder())->buildForForm();
        $existing = $this->getDoctrine()->getEntityManager()->getRepository(MapLayer::class)->findAll();
        if ($existing) {
            $layers = new MapLayersUpdate($existing);
        }
        $form = $this->getForm($layers);
        return $this->render('AppBundle:Map:view.html.twig', array(
            'form'  => $form->createView(),// ...
            'update' => $layers
        ));
    }

    /**
     * @param Request $request
     * @Route("/map/update", name="update_map")

     */
    public function updateLayersAction(Request $request)
    {
        $form = $this->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            foreach ($form->getData()->getMapLayers() as $layer) {
                $this->getDoctrine()->getEntityManager()->persist($layer);
            }
            $this->getDoctrine()->getEntityManager()->flush();
        }
        return $this->redirectToRoute('view_map');
    }

}
