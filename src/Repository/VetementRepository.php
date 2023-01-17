<?php

namespace App\Repository;

use App\Entity\Categorie;
use App\Entity\Vetement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vetement>
 *
 * @method Vetement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vetement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vetement[]    findAll()
 * @method Vetement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VetementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vetement::class);
    }

    public function add(Vetement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Vetement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Vetement[] Returns an array of Vetement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Vetement
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

/**
* @return Vetement[] Returns an array of Vetement objects
*/
    public function lastProducts()
   {
    return $this->createQueryBuilder('p')
    ->orderBy('p.id', 'DESC')
    ->setMaxResults(5)
    ->getQuery()
    ->getResult();

   }

   /**
* @return Vetement[] Returns an array of Vetement objects
*/
public function findAllCategorie(Categorie $categorie): array
{
    $c_id=$categorie->getId();
 return $this->createQueryBuilder('p')
  ->leftJoin('p.categorie', 'categorie')
 ->where('categorie.id =:c_id ')
 ->andWhere('p.dispo =:dispo ')
//  ->having('COUNT(categorie) > 0 ')
 ->setParameter('c_id',$c_id)
 ->setParameter('dispo',1)
 ->getQuery()
 ->getResult();

}

/**
* @return Vetement[] Returns an array of Vetement objects
*/
public function all()
{
 return $this->createQueryBuilder('p')
 ->orderBy('p.id', 'DESC')
 ->where('p.dispo =:dispo ')
 ->setParameter('dispo',1)
 ->getQuery()
 ->getResult();

}

/**
* @return Vetement[] Returns an array of Vetement objects
*/
public function filter($search): array
{
 return $this->createQueryBuilder('p')
  ->leftJoin('p.categorie', 'categorie')
 ->where('categorie.nom LIKE :search ')
 ->orWhere('categorie.description LIKE :search ')
 ->orWhere('p.nom LIKE :search ')
 ->orWhere('p.description LIKE :search ')
 ->andWhere('p.dispo =:dispo ')
//  ->having('COUNT(categorie) > 0 ')
 ->setParameter('search','%'.$search.'%')
 ->setParameter('dispo',1)
 ->getQuery()
 ->getResult();

}

}
