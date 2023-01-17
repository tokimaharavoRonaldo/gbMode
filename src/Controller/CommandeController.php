<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Repository\CommandeRepository;
use App\Service\Panier\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande", name="app_validate_commande")
     */
    public function index(CommandeRepository $commandeRepository): Response
    {
        $commande=$commandeRepository->addCommande();
        $this->addFlash('success', 'commande reussi');
        return $this->redirectToRoute('app_home');
    }
}
