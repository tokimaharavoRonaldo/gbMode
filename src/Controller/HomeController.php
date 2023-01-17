<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\AproposRepository;
use App\Repository\CategorieRepository;
use App\Repository\VetementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(VetementRepository $vetement,AproposRepository $apropos): Response
    {
        $vetement=$vetement->lastProducts();
        
        return $this->render('home/index.html.twig', [
            'vetement' => $vetement,
            'apropos' => $apropos->apropos()
        ]);
    }
}
