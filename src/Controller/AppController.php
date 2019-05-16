<?php

namespace App\Controller;

use App\Entity\GameCharacter;
use App\Entity\GameUser;
use App\Entity\GameUserCharacter;
use App\Entity\User;
use App\Form\UserType;
use App\Services\Character;
use App\Services\NotificationService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Yaml\Yaml;

class AppController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request,  UserPasswordEncoderInterface $passwordEncoder, NotificationService $notificationService)
    {
        if ($this->isGranted('IS_AUTHENTICATED_ANONYMOUSLY') && !$this->isGranted('ROLE_USER')) {
            // création du formulaire
            $user = new User();
            // instancie le formulaire avec les contraintes par défaut, + la contrainte registration pour que la saisie du mot de passe soit obligatoire
            $form = $this->createForm(UserType::class, $user, [
                'validation_groups' => array('User', 'registration'),
            ]);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                // Encode password
                $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($password);

                // Create game user
                $gameUser = new GameUser();
                $gameUser->setUser($user);
                $user->setGameUser($gameUser);

                // Create game user list character
                $characterRepository = $em->getRepository('App:GameCharacter');

                $defaultCharacters = Yaml::parseFile('../config/dataGame/defaultCharacters.yaml');
                foreach ($defaultCharacters['id'] as $id) {
                    /** @var GameCharacter $character */
                    $character = $characterRepository->findOneBy(['id' => $id]);

                    $gameUserCharacter = new GameUserCharacter();
                    $gameUserCharacter->setUserId($user)
                        ->setCharacter($character);
                    $em->persist($gameUserCharacter);
                }

                $em->persist($gameUser);
                $em->persist($user);

                $em->flush();

                $this->addFlash('success', "Votre compte est enregistré.");

                return $this->redirectToRoute('login');
            }

            return $this->render('index.html.twig', [
                'form' => $form->createView()
            ]);
        } else {
//            dump($notificationService);

//            $notificationService->sendNotification($this->getUser(), "Test notification");

            return $this->render('index.html.twig', [

            ]);
        }
    }

    /**
     * @Route("/change-cc/{slug}", name="change-cc")
     */
    public function changeCC(Request $request)
    {
        $em                 = $this->getDoctrine()->getManager();
        $slug               = $request->get('slug');
        $gameCharacterRepo  = $em->getRepository('App:GameCharacter');
        $gameCharacter      = $gameCharacterRepo->findOneBy(['slug' => $slug]);
        $gameUser           = $this->getUser()->getGameUser();

        $gameUser->setCurrentCharacter($gameCharacter->getId());

        $em->persist($gameUser);
        $em->flush();
        $this->addFlash('success', 'Votre nouveau personnage est désormais '.$gameCharacter->getName());
        return $this->redirect($request->headers->get('referer'));
    }
}
