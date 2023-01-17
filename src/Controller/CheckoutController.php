<?php

namespace App\Controller;

use App\Form\RegistrationFormType;
use App\Service\Panier\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutController extends AbstractController
{
    private $session;
    private $panier;
    public function __construct(PanierService $panierService ,SessionInterface $session ){
        $this->session=$session;
        $this->panierService=$panierService;

    }

    /**
     * @Route("/checkout", name="app_checkout")
     */
    public function index(Request $request ): Response
    {
        $panier=$request->get('qty');
        $this->panierService->updatePanier($panier);
        $user=$this->getUser();

        if (empty($user)){
            return $this->redirectToRoute('app_login');
        }
        $panier=$this->panierService->getFullPanier();

        if(empty($panier)){
            return $this->redirectToRoute('app_vetement');
        }
        $total=$this->panierService->getTotal($panier);
        $form=$this->createForm(RegistrationFormType::class,$user);

        return $this->render('checkout/index.html.twig', [
            'controller_name' => 'CheckoutController',
            'total' => $total,
            'user' => $user,
            'items' => $panier
        ]);
    }
}
