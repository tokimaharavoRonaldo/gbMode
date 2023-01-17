<?php
namespace App\Service\Panier;

use App\Repository\VetementRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierService{
    protected $session;
    protected $productRepository;

    public function __construct(SessionInterface $session,VetementRepository $productRepository)
    {
        $this->session=$session;
        $this->productRepository=$productRepository;
        
    }

    public function addPanier(int $id){
        $panier=$this->session->get('panier',[]);

        if(!empty($panier[$id])){
        $panier[$id]++;
        }
        else{
            $panier[$id]=1;
        }
            $this->session->set('panier',$panier);
            //die($request->query->get('qte'));
        
    }

    public function removePanier(int $id){
        $panier=$this->session->get('panier',[]);
        if(!empty($panier[$id])){
            unset($panier[$id]);
        }
        $this->session->set('panier',$panier);

    }

     public function viderPanier(){
        $panier=$this->session->get('panier',[]);
        if(!empty($panier)){
            // unset($panier);
            // $panier[]=[];
        }
        $this->session->set('panier',[]);

    }

    public function getFullPanier() : array
    {
        $panier=$this->session->get('panier',array());
        $panierWithData=[];

        foreach($panier as $id => $quantity){
           $panierWithData[]=[
               'product'=>$this->productRepository->find($id),
               'quantity'=>$quantity,
               'id'=>$id
           ];
        }
        return $panierWithData;
    }

    public function getTotal($panierWithData) : float
    {
        $total=0;
        foreach($panierWithData as $item){
            $totalItem=$item['product']->getPrix ()* $item['quantity'];
            $total +=$totalItem;
         }
         return $total;

    }

    public function nmbreProductOnPanier(){
       $panierWithData = $this->getFullPanier();
       $count=count($panierWithData);
       return $count;
    }

    public function updatePanier($panier){
        $this->session->set('panier',$panier);
    }
}
