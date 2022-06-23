<?php

namespace App\Repository;

use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Customer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customer[]    findAll()
 * @method Customer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }

    // /**
    //  * @return Customer[] Returns an array of Customer objects
    //  */
    // public function findByCusAsc()
    // {
    //     $entity = $this->getEntityManager();

    //     return $this->createQueryBuilder('c')
    //         ->select('c.id','c.name','c.birthDate', 'c.isYoungDriver')
    //         ->orderBy('c.birthDate','ASC')
    //         ->addOrderBy('c.isYoungDriver','ASC')
    //         ->getQuery()
    //         ->getArrayResult();
    //     ;
    // }
    // public function findByCusDesc()
    // {
    //     $entity = $this->getEntityManager();

    //     return $this->createQueryBuilder('c')
    //         ->select('c.id','c.name','c.birthDate', 'c.isYoungDriver')
    //         ->orderBy('c.birthDate','DESC')
    //         ->addOrderBy('c.isYoungDriver','DESC')
    //         ->getQuery()
    //         ->getArrayResult();
    //     ;
    // }
    
    /**
     * @return Customer[] Returns an array of Customer objects
     */
    public function findByCusAsc()
    {
        return $this->createQueryBuilder('c')
            ->select('c.name, c.birthDate, c.isYoungDriver')
            ->orderBy('c.birthDate', 'ASC')
            ->addOrderBy('c.isYoungDriver', 'ASC')
            ->getQuery()
            ->getArrayResult()
        ;
    }
    public function findByCusDesc()
    {
        return $this->createQueryBuilder('c')
            ->select('c.name, c.birthDate, c.isYoungDriver')
            ->orderBy('c.birthDate', 'DESC')
            ->addOrderBy('c.isYoungDriver', 'DESC')
            ->getQuery()
            ->getArrayResult()
        ;
    }
    public function findByCusIdSale($id)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql ='SELECT cus.name,
        (SELECT COUNT(s.car_id) FROM Sale s, Customer cus where 
        s.customer_id=cus.id AND cus.id = :id) AS "Bought cars count",
        SUM(p.price*(1-s.discount)) AS "Total spent money" FROM Customer cus, Sale s, Car c, car_part cp,
        Part p where cus.id=s.customer_id AND c.id=s.car_id AND c.id=cp.car_id AND cp.part_id=p.id AND cus.id = :id
        GROUP BY (s.customer_id)';

        $s = $conn->prepare($sql);
        $s->execute(['id'=>$id]);
        return $s->fetchAllAssociative();
    }

    // /**
    //  * @return Customer[] Returns an array of Customer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Customer
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
