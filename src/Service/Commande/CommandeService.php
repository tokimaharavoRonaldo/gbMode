<?php
namespace App\Service\Commande;

use App\Repository\CommandeRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CommandeService{
    protected $session;
    protected $commandeRepository;

    public function __construct(SessionInterface $session,CommandeRepository $commandeRepository)
    {
        $this->session=$session;
        $this->commandeRepository=$commandeRepository;
        
    }
    
    public function createCommande(){
        
    }

}