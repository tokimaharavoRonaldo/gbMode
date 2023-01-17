<?php

namespace App\Repository;

use App\Entity\Commande;
use App\Entity\CommandeProduit;
use App\Service\Panier\PanierService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;

/**
 * @extends ServiceEntityRepository<Commande>
 *
 * @method Commande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande[]    findAll()
 * @method Commande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeRepository extends ServiceEntityRepository
{
    private $session;
    private $productRepository;
    private $panierService;
    private $security;
    public function __construct(ManagerRegistry $registry,Security $security,PanierService $panierService,SessionInterface $session,VetementRepository $productRepository)
    {
        $this->session=$session;
        $this->panierService=$panierService;
        $this->security=$security;
        $this->productRepository=$productRepository;
        parent::__construct($registry, Commande::class);
    }

    public function addCommande()
    {
        //price total
        $panierWithData=$this->panierService->getFullPanier();
       $total=$this->panierService->getTotal($panierWithData);

       //user
       $user=$this->security->getUser();

       //date
       $date=new \DateTime();
    //     $newDate = $date->format('Y-m-d');
    //    $the_date=date('Y-m-d H:i:s',strtotime($date_tr));
    //    $date_transaction=new \DateTime($the_date);

        $commande= new Commande();
        $commande->setDateCmd($date);
        $commande->setEtatCmd(1);
        $commande->setPrixTotal($total);
        $commande->setUser($user);
        $panier=$this->session->get('panier',array());
        $panierWithData=[];

        foreach($panier as $id => $quantity){
            
            $produit=$this->productRepository->find($id);
            $commande->addVetement($produit);
            $this->getEntityManager()->persist($commande);
            $commandeProduit= new CommandeProduit();
            $commandeProduit->setQte($quantity);
            $commandeProduit->setVetement($produit);
            $commandeProduit->setCommande($commande);
            $this->getEntityManager()->persist($commandeProduit);
    
        }
        $this->getEntityManager()->persist($commande);

      
            $this->getEntityManager()->flush();
           
        $this->panierService->viderPanier();

      
    }

    public function remove(Commande $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Commande[] Returns an array of Commande objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Commande
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
