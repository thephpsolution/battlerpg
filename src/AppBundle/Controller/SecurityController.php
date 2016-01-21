<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MapLayer;
use AppBundle\Entity\MapPointSet;
use AppBundle\Entity\User;
use AppBundle\Form\MapLayersType;
use AppBundle\Map\MapEditorBuilder;
use AppBundle\ValueObject\MapLayersUpdate;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller
{
    private function getForm($layers = null)
    {
        return $this->createForm(MapLayersType::class, $layers ?: (new MapEditorBuilder())->buildForForm(), [
            'action' => $this->generateUrl('update_map')
        ]);
    }
    /**
     * @Route("/game-login", name="game_login")
     */
    public function loginAction()
    {
        /** @var User $user */
        $user = $this->container->get('security.context')->getToken()->getUser();

        return $response = new JsonResponse([
            'user' => (object)[
                'name' => $user === 'anon.' ? 'Guest' : $user->getUsername(),
                'admin' => $user === 'anon.' ? false : $user->hasRole('ROLE_ADMIN'),
            ]
        ]);
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
