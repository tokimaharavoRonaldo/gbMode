<?php

namespace App\Tests;

use App\Entity\Categorie;
use App\Entity\CmdLine;
use App\Entity\Panier;
use App\Entity\Vetement;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class VetementUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $user= new User();
        $panier= new Panier();
        $vetement= new Vetement();
        $cmd_line = new CmdLine();
        $categorie = new Categorie();

        
        $vetement->setPrix(20.20)
        ->setNom('nom')
        ->setDescription('description')
        ->setTaille('M')
        ->setFile('file')
        ->addPanier($panier)
        ->addCmdLine($cmd_line)
        ->setSlug('slug')
        ->setDispo(true)
        ->setCategorie($categorie);
        // $this->assertTrue(true);
        $this->assertTrue($vetement->getNom() === 'nom');
        $this->assertTrue($vetement->getPrix() == 20.20);
        $this->assertTrue($vetement->getDescription()=== 'description');
        $this->assertTrue($vetement->getTaille()=== 'M');
        $this->assertTrue($vetement->getFile()=== 'file');
        $this->assertTrue($vetement->getSlug()=== 'slug');
        $this->assertTrue($vetement->isdispo()=== true);
        $this->assertContains($panier,$vetement->getPaniers());
        $this->assertContains($cmd_line,$vetement->getCmdLines());
        $this->assertTrue($vetement->getCategorie()=== $categorie);
       
    }

    public function testIsFalse()
    {
        $user= new User();
        $panier= new Panier();
        $vetement= new Vetement();
        $cmd_line = new CmdLine();
        $categorie = new Categorie();

        
        $vetement->setPrix(20.20)
        ->setNom('nom')
        ->setDescription('description')
        ->setTaille('M')
        ->setFile('file')
        ->addPanier($panier)
        ->addCmdLine($cmd_line)
        ->setSlug('slug')
        ->setDispo('true')
        ->setCategorie($categorie);
        // $this->assertTrue(true);
        $this->assertFalse($vetement->getNom()=== 'false');
        $this->assertFalse($vetement->getPrix() == 22.20);
        $this->assertFalse($vetement->getDescription()=== 'false');
        $this->assertFalse($vetement->getTaille()=== 'false');
        $this->assertFalse($vetement->getFile()=== 'false');
        $this->assertFalse($vetement->getSlug()=== 'false');
        $this->assertFalse($vetement->isdispo()=== false);
        $this->assertNotContains(new Panier(),$vetement->getPaniers());
        $this->assertNotContains(new CmdLine(),$vetement->getCmdLines());
        $this->assertFalse($vetement->getCategorie()=== new Categorie());
       
    }

    public function testIsEmpty()
    {
        $vetement= new Vetement();
      
        $this->assertEmpty($vetement->getNom());
        $this->assertEmpty($vetement->getPrix());
        $this->assertEmpty($vetement->getDescription());
        $this->assertEmpty($vetement->getTaille());
        $this->assertEmpty($vetement->getFile());
        $this->assertEmpty($vetement->getSlug());
        $this->assertEmpty($vetement->isdispo());
        $this->assertEmpty($vetement->getPaniers());
        $this->assertEmpty($vetement->getCmdLines());
        $this->assertEmpty($vetement->getCategorie());
       
    }

}
