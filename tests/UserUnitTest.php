<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\User;

class UserUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $user= new User();
        $user->setEmail('true@test.com')
        ->setNom('nom')
        ->setPrenom('prenom')
        ->setPassword('password')
        ->setTelephone('telephone');
        // $this->assertTrue(true);
        $this->assertTrue($user->getEmail()=== 'true@test.com');
        $this->assertTrue($user->getNom()=== 'nom');
        $this->assertTrue($user->getPrenom()=== 'prenom');
        $this->assertTrue($user->getPassword()=== 'password');
        $this->assertTrue($user->getTelephone()=== 'telephone');
       
    }

    public function testIsFalse()
    {
        $user= new User();
        $user->setEmail('true@test.com')
        ->setNom('nom')
        ->setPrenom('prenom')
        ->setPassword('password')
        ->setTelephone('telephone');
        // $this->assertTrue(true);
        $this->assertFalse($user->getEmail()=== 'false@test.com');
        $this->assertFalse($user->getNom()=== 'false');
        $this->assertFalse($user->getPrenom()=== 'false');
        $this->assertFalse($user->getPassword()=== 'false');
        $this->assertFalse($user->getTelephone()=== 'false');
       
    }

    public function testIsEmpty()
    {
        $user= new User();

        // $this->assertTrue(true);
        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getNom());
        $this->assertEmpty($user->getPrenom());
        $this->assertEmpty($user->getPassword());
        $this->assertEmpty($user->getTelephone());
       
    }
}
