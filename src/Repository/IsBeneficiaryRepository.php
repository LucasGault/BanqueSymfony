<?php

namespace App\Repository;

use App\Entity\IsBeneficiary;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IsBeneficiary|null find($id, $lockMode = null, $lockVersion = null)
 * @method IsBeneficiary|null findOneBy(array $criteria, array $orderBy = null)
 * @method IsBeneficiary[]    findAll()
 * @method IsBeneficiary[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IsBeneficiaryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IsBeneficiary::class);
    }

    // /**
    //  * @return IsBeneficiary[] Returns an array of IsBeneficiary objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IsBeneficiary
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
