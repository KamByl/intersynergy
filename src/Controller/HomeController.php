<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     * @IsGranted("IS_AUTHENTICATED_REMEMBERED")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
        ]);
    }
}
