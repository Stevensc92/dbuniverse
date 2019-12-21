<?php

namespace App\Controller;

use App\Entity\GameCapsule;
use App\Entity\GameCapsuleCorp;
use App\Entity\User;
use App\Services\CapsuleCorp;
use App\Services\Character;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AjaxController
 * @package App\Controller
 * @Route("/ajax")
 */
class AjaxController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }
    /**
     * @Route("/add-carac", name="add.carac", methods="POST")
     *
     */
    public function index(Request $request, Character $serviceCharacter)
    {
        $response = [
            'Not a xml request',
            Response::HTTP_BAD_REQUEST
        ];

        if ($request->isXmlHttpRequest()) {

            $user               = $this->getUser();
            $em                 = $this->em;
            $CC                 = $serviceCharacter->getCurrentCharacter();

            $response           = [];
            $fieldsAvailable    = [
                'power',
                'defense',
                'magic',
                'luck',
                'speed',
                'concentration',
                'life',
                'energy'
            ];
            $pointsAvailable    = $request->request->get('pointsAvailable');
            $formData           = $request->request->get('data');

            $pointsAdded = 0;
            $error = false;

            $explodeData = explode('&', $formData);

            foreach ($explodeData as $input) {
                if ($pointsAdded <= $pointsAvailable) {
                    list($field, $value) = explode('=', $input);

                    if ($field === 'token') {
                        if (!$this->isCsrfTokenValid($user->getId(), $value)) {
                            $error = 'Erreur de token';
                        }
                    }

                    if (in_array($name = str_replace('add_', '', $field), $fieldsAvailable) && !$error) {
                        if ($value !== '') {
                            $method = 'up'.ucfirst($name);

                            if($CC->$method($value)) {
                                switch($name) {
                                    case "life":
                                        $value = $value / 100;
                                    break;

                                    case "energy":
                                        $value = $value / 5;
                                    break;
                                }
                                $pointsAdded += $value;
                            } else {
                                $error = "Problem in request";
                            }
                        }
                    }

                } else {
                    $error = 'Plus de points que nécessaire ont été entré.';
                }
            }

            if ($error !== false) {
                $response = [
                    $error,
                    Response::HTTP_BAD_REQUEST
                ];
            } else {
                $CC->updateKi();
                $em->flush();
                $response = [
                    json_encode([
                        "power"         => $CC->getPower(),
                        "defense"       => $CC->getDefense(),
                        "magic"         => $CC->getMagic(),
                        "luck"          => $CC->getLuck(),
                        "speed"         => $CC->getSpeed(),
                        "concentration" => $CC->getConcentration(),
                        "life"          => $CC->getLife(),
                        "energy"        => $CC->getEnergy(),
                    ]),
                    Response::HTTP_OK,
                ];
            }
        }

        return new Response($response[0], $response[1]);
    }

    /**
     * @Route("/buy-capsule", name="game.buy.capsule", methods="POST")
     * @param Request $request
     * @param CapsuleCorp $capsuleCorp
     * @return Response
     */
    public function buyCapsule(Request $request, CapsuleCorp $capsuleCorp)
    {
        if ($request->isXmlHttpRequest()) {

            $data           = $request->request->get('data');
            $capsuleId      = $data['capsule'];
            $em             = $this->em;

            /** @var GameCapsule $capsule */
            $capsule        = $em->getRepository(GameCapsule::class)->find($capsuleId);

            if ($checkIn = $capsuleCorp->buyCapsule($capsule)) {
                $response = [
                    $checkIn,
                    Response::HTTP_OK
                ];
            } else {
                $response =  [
                    $checkIn,
                    Response::HTTP_BAD_REQUEST,
                ];
            }
        } else {
            $response = [
                "Not an ajax request",
                Response::HTTP_BAD_REQUEST
            ];
        }

        return new Response(json_encode($response[0]), $response[1]);
    }
}
