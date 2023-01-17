<?php

namespace App\Controller;

use App\Repository\VetementRepository;
use App\Service\Panier\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class PanierController extends AbstractController
{

 /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
       $this->security = $security;
    }

    /**
     * @Route("/panier", name="app_panier")
     */
    public function index(SessionInterface $session,VetementRepository $productRepository,PanierService $panierService): Response
    {
         $user = $this->security->getUser();
        
       $panierWithData=$panierService->getFullPanier();
       $total=$panierService->getTotal($panierWithData);

        return $this->render('panier/index.html.twig', [
            'items' => $panierWithData,
            'total' => $total
        ]);
    }

      /**
     * @Route("/add/panier/{id}", name="app_panier_add")
     */
    public function add($id,PanierService $panierService): Response
    {
        $panierService->addPanier($id);
  
    return $this->redirectToRoute('app_panier');
    }
    
    /**
     * @Route("/panier/remove/{id}",name="app_panier_remove")
     */

    public function remove($id,Request $request,PanierService $panierService)
    {
       
        $panierService->removePanier($id);

        return $this->redirectToRoute('app_panier');
        
    }

    /**
     * @Route("/panier/vide",name="app_panier_vide")
     */

    public function vider(PanierService $panierService)
    {
        $panierService->viderPanier();

        return $this->redirectToRoute('app_vetement');
        
    }

    
      /**
     * @Route("/ajax/add/panier", name="ajax_app_panier_add")
     */
    public function ajaxAdd(Request $request,PanierService $panierService)
    {

        if ( $request->query->has('id')) {
            $id = $request->query->get('id');
        $panierService->addPanier($id);
  
        $count=$panierService->nmbreProductOnPanier();
        return new Response(json_encode($count));
        }
    return $this->redirectToRoute('app_panier');
    }


    
    /**
     * @Route("/ajax/nbre/panier", name="ajax_nbre_panier")
     */
    public function NbrePanier(Request $request,PanierService $panierService)
    {

        $count=$panierService->nmbreProductOnPanier();
        return new Response(json_encode($count));
    
    }
}
