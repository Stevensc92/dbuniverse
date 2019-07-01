<?php

namespace App\Controller;

use App\Form\AddCaracType;
use App\Services\Character;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CharacterController extends AbstractController
{
    /**
     * @Route("/character", name="game.character")
     */
    public function index(Character $serviceCharacter)
    {
        $CC = $serviceCharacter->getCurrentCharacter();

        if ($CC->getPointsToDistribute() > 0) {
            $form = $this->createForm(AddCaracType::class, $CC);

            return $this->render('character/index.html.twig', [
                'form' => $form->createView()
            ]);
        }

        return $this->render('character/index.html.twig', [
            'controller_name' => 'CharacterController',
        ]);
    }
}
