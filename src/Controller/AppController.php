<?php

namespace App\Controller;

use App\Entity\GameListUserCharacter;
use App\Entity\GameUser;
use App\Entity\User;
use App\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request,  UserPasswordEncoderInterface $passwordEncoder)
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
                $gameListUserCharacter = new GameListUserCharacter();
                $gameListUserCharacter->setUserId($user);

                $em->persist($gameListUserCharacter);
                $em->persist($gameUser);
                $em->persist($user);

                $em->flush();

                $request->getSession()->getFlashBag()->add('success', "Votre compte est enregistré.");

                return $this->redirectToRoute('login');
            }

            return $this->render('index.html.twig', [
                'form' => $form->createView()
            ]);
        } else {
            return $this->render('index.html.twig', [

            ]);
        }
    }

}
