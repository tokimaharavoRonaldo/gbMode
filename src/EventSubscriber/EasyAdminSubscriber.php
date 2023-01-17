<?php

namespace App\EventSubscriber;

use App\Entity\Vetement;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $slugger;
    // private $security;

    public function __construct(SluggerInterface $slugger,Security $security )
    {
        $this->slugger=$slugger;
        // $this->security=$security;
    }

    public static function getSubscribedEvents()
    {
        return[
            BeforeEntityPersisterEvent::class =>['setProductSlug']
        ];
    }

    public function setProductSlug(BeforeEntityPersistedEvent $event){
        $entity=$event->getEntityInstance();

        if(!($entity instanceof Vetement)){
            return;   
        }
        $slug=$this->slugger->slug($entity->getNom());
        $entity->setSlug($slug);
        
        $user =$this->security->getUser();
        // $entity->setUser($user);
    }
}