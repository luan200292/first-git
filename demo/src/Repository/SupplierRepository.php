<?php

namespace App\Repository;

use App\Entity\Supplier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Supplier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Supplier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Supplier[]    findAll()
 * @method Supplier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupplierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Supplier::class);
    }

    // /**
    //  * @return Supplier[] Returns an array of Supplier objects
    //  */
    // public function findBySupLoc($value)
    // {
    //     $entity = $this->getEntityManager();

    //     return $this->createQueryBuilder('s')
    //         ->select('s.id', 's.name', 's.isImporter')
    //         ->where('s.isImporter = :isImporter')
    //         ->setParameter('isImporter',$value)
    //         ->getQuery()
    //         ->getArrayResult()
    //     ;
    // }
    // /**
    //  * @return Supplier[] Returns an array of Supplier objects
    //  */
    // public function findBySupImp($value)
    // {
    //     $entity = $this->getEntityManager();

    //     return $this->createQueryBuilder('s')
    //         ->select('s.id', 's.name', 's.isImporter', 'p.quantity')
    //         ->where('s.isImporter = :isImporter')
    //         ->setParameter('isImporter',$value)
    //         ->getQuery()
    //         ->getArrayResult()
    //     ;
    // }

    // /**
    //  * @return Supplier[]
    //  */
    // public function findBySupLocal()
    // {
    //     $entity = $this->getEntityManager();
    //     return $entity->createQuery('
    //         select s.id, s.name, p.quantity 
    //         from App\Entity\Supplier s,
    //         App\Entity\Part p 
    //         where s.id = p.id and s.isImporter = 1
    //      ')
    //      ->getArrayResult();
    // }
    // /**
    //  * @return Supplier[]
    //  */
    // public function findBySupImporter()
    // {
    //     $entity = $this->getEntityManager();
    //     return $entity->createQuery('
    //         select s.id, s.name, p.quantity 
    //         from App\Entity\Supplier s,
    //         App\Entity\Part p 
    //         where s.id = p.id and s.isImporter = 0
    //      ')
    //      ->getArrayResult();
    // }

    /**
     * @return Supplier[] Returns an array of Supplier objects
     */
    public function findBySupLocal()
    {
        // SELECT s.id, s.name, p.quantity 
        // FROM supplier s, part p WHERE s.id = p.id AND s.is_importer = 0
        $entity = $this->getEntityManager();
        return $entity->createQuery('
        SELECT s.id, s.name, p.quantity
        FROM App\Entity\Supplier s,
        App\Entity\Part p WHERE s.id = p.id AND s.isImporter = 0
        ')
        ->getArrayResult()
        ;
    }
    public function findBySupImporter()
    {
        // SELECT s.id, s.name, p.quantity 
        // FROM supplier s, part p WHERE s.id = p.id AND s.is_importer = 1
        $entity = $this->getEntityManager();
        return $entity->createQuery('
        SELECT s.id, s.name, p.quantity
        FROM App\Entity\Supplier s,
        App\Entity\Part p WHERE s.id = p.id AND s.isImporter = 1
        ')
        ->getArrayResult()
        ;
    }
    

    // /**
    //  * @return Supplier[] Returns an array of Supplier objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Supplier
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
