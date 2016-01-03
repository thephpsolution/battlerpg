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
use Symfony\Component\Security\Core\SecurityContext;

class MapController extends Controller
{
    private function getForm($layers = null)
    {
        return $this->createForm(MapLayersType::class, $layers ?: (new MapEditorBuilder())->buildForForm(), [
            'action' => $this->generateUrl('update_map')
        ]);
    }

    /**
     * @Route("/", name="view_map")
     */
    public function viewAction()
    {
        $layers = (new MapEditorBuilder())->buildForForm();
        $existing = $this->getDoctrine()->getEntityManager()->getRepository(MapLayer::class)->findAll();
        if ($existing) {
            $layers = new MapLayersUpdate($existing);
        }
        $form = $this->getForm($layers);


        $request = $this->container->get('request');
        /* @var $request \Symfony\Component\HttpFoundation\Request */
        $session = $request->getSession();
        /* @var $session \Symfony\Component\HttpFoundation\Session\Session */

        if (!$this->container->get('security.context')->getToken()->getUser() || $this->container->get('security.context')->getToken()->getUser() === "anon.") {
            return $this->redirect('/login');
        }

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        if ($error) {
            // TODO: this is a potential security risk (see http://trac.symfony-project.org/ticket/9523)
            $error = $error->getMessage();
        }
        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);

        $csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');

        $this->container->get('security.context')->getToken()->getUser()->addRole('ROLE_ADMIN');
        return $this->render('AppBundle:Map:view.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'csrf_token' => $csrfToken,
            'user'      => $user = $this->container->get('security.context')->getToken()->getUser(),
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
