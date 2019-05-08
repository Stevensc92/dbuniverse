<?php

namespace App\Controller;

use App\Services\Character;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends AbstractController
{
    private $limitX = [
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'
    ];

    private $limitY = [
        1, 2, 3, 4, 5, 6, 7, 8, 9, 10
    ];
    /**
     * @Route("/map", name="game.map")
     */
    public function index()
    {

        return $this->render('map/index.html.twig', [
        ]);
    }

    /**
     * @Route("/map/move-to/{x}/{y}", name="game.map.change.position")
     */
    public function changePosition(Request $request)
    {
        $tk = $this->container->get('security.token_storage');
        $em = $this->getDoctrine()->getManager();

        $serviceCharacter = new Character($em, $tk);
        $CC = $serviceCharacter->getCurrentCharacter();

        $x = $request->get('x');
        $y = $request->get('y');

        if (!in_array(ucfirst($x), $this->limitX) || !in_array($y, $this->limitY)) {
            $this->addFlash('error', 'Position incorrect');
            return $this->redirect($request->headers->get('referer'));
        }


        $CC->setX($request->get('x'))
            ->setY($request->get('y'));

        $em->persist($CC);
        $em->flush();

        $this->addFlash('success', 'Déplacement réussie');

        return $this->redirect($request->headers->get('referer'));
    }
}
