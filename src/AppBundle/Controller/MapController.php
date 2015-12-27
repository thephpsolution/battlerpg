<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MapController extends Controller
{
    /**
     * @Route("/view")
     */
    public function viewAction()
    {
        return $this->render('AppBundle:Map:view.html.twig', array(
            // ...
        ));
    }

}
