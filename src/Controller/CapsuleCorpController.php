<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CapsuleCorpController extends AbstractController
{
    /**
     * @Route("/display-store", name="capsule_corp")
     */
    public function index()
    {
        return $this->render('capsule-corp/store.html.twig');
    }
}
