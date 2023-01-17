<?php

namespace App\Controller;

use App\Repository\AproposRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AproposController extends AbstractController
{
    /**
     * @Route("/apropos", name="app_apropos")
     */
    public function index(AproposRepository $apropos): Response
    {
        
        return $this->render('apropos/index.html.twig', [
            'apropos' => $apropos->apropos()
        ]);
    }
}
