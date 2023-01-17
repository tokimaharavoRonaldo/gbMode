<?php

namespace App\Tests;

use App\Entity\Commande;
use App\Entity\Panier;
use App\Entity\Vetement;
use DateTime;
use PHPUnit\Framework\TestCase;

class CommandeUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $commande= new Commande();
        $datetime= new DateTime();
        $vetement= new Vetement();
        
        $commande
        ->setDateCmd($datetime)
        ->setPrixTotal(20.20)
        ->addVetement($vetement)
        ->setEtatCmd(false);
        
        $this->assertTrue($commande->getDateCmd()=== $datetime);
        $this->assertContains($vetement,$commande->getVetement());
        $this->assertTrue($commande->isEtatCmd()=== false);
        $this->assertTrue($commande->getPrixTotal() == 20.20);
       
    }

    public function testIsFalse()
    {
        $commande= new Commande();
        $datetime= new DateTime();
        $vetement= new Vetement();
        
        $commande
        ->setDateCmd($datetime)
        ->setPrixTotal(20.20)
        ->setEtatCmd(false)
        ->addVetement($vetement);
        
        $this->assertFalse($commande->getDateCmd()=== new DateTime());
        $this->assertNotContains(new Vetement(),$commande->getVetement());
        $this->assertFalse($commande->isEtatCmd()=== true);
        $this->assertFalse($commande->getPrixTotal()== 22.20);
       
    }

    public function testIsEmpty()
    {
        $commande= new Commande();
        
        $this->assertEmpty($commande->getDateCmd());
        $this->assertEmpty($commande->getVetement());
        $this->assertEmpty($commande->isEtatCmd());
        $this->assertEmpty($commande->getPrixTotal());
       
    }
}
