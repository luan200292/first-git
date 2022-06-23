<?php

namespace App\Repository;

use App\Entity\Sale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sale|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sale|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sale[]    findAll()
 * @method Sale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sale::class);
    }

    /**
     * @return Sale[] Returns an array of Sale objects
     */
    public function findByAllSales()
    {
        $entity = $this->getEntityManager();
        return $this->createQueryBuilder('s')
            ->select('s.id as saleid, cus.id as cusid, ca.id as carid, s.discount')
            ->innerJoin('s.customer', 'cus')
            ->innerJoin('s.car', 'ca')
            ->getQuery()
            ->getArrayResult()
        ;
    }
    public function findBySalesId($id)
    {
        $entity = $this->getEntityManager();
        return $this->createQueryBuilder('s')
            ->select('s.id as saleid, cus.id as cusid, ca.id as carid, s.discount,
            ca.make, ca.model, ca.travelledDistance')
            ->where('s.id = :id')
            ->setParameter('id', $id)
            ->innerJoin('s.customer', 'cus')
            ->innerJoin('s.car', 'ca')
            ->getQuery()
            ->getArrayResult()
        ;
    }
    public function findBySalesDis($discount)
    {
        $entity = $this->getEntityManager();
        return $this->createQueryBuilder('s')
            ->select('s.id as saleid, cus.id as cusid, ca.id as carid, s.discount,
            ca.make, ca.model, ca.travelledDistance')
            ->where('s.discount = :discount')
            ->setParameter('discount', $discount)
            ->innerJoin('s.customer', 'cus')
            ->innerJoin('s.car', 'ca')
            ->getQuery()
            ->getArrayResult()
        ;
    }
    

    // /**
    //  * @return Sale[] Returns an array of Sale objects
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
    public function findOneBySomeField($value): ?Sale
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
