<?php

namespace App\Repository;

use App\Entity\MedicGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MedicGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method MedicGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method MedicGroup[]    findAll()
 * @method MedicGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicGroupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MedicGroup::class);
    }

    // /**
    //  * @return MedicGroup[] Returns an array of MedicGroup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MedicGroup
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
