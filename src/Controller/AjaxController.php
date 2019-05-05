<?php

namespace App\Controller;

use App\Services\Character;
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
    /**
     * @Route("/add-carac", name="add.carac", methods="POST")
     *
     */
    public function index(Request $request)
    {
        $response = [
            'Not a xml request',
            Response::HTTP_BAD_REQUEST
        ];

        if ($request->isXmlHttpRequest()) {
            $user = $this->getUser();

            $tk = $this->container->get('security.token_storage');
            $em = $this->getDoctrine()->getManager();

            $serviceCharacter = new Character($em, $tk);
            $CC = $serviceCharacter->getCurrentCharacter();

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
            foreach (explode('&', $formData) as $input) {
                if ($pointsAdded <= $pointsAvailable) {
                    list($field, $value) = explode('=', $input);

                    if (in_array($name = str_replace('add_', '', $field), $fieldsAvailable)) {
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
                $em->persist($CC);
                $em->flush();
                $response = [
                    ($pointsAvailable - $pointsAdded),
                    Response::HTTP_OK
                ];
            }

        }

        return new Response($response[0], $response[1]);
    }
}
