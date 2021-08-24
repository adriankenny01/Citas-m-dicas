<?php

namespace App\Repository;

use App\Entity\Patient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Patient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Patient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Patient[]    findAll()
 * @method Patient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatientRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Patient::class);
    }

    // /**
    //  * @return Patient[] Returns an array of Patient objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Patient
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function countAll()
    {
        return $this->createQueryBuilder('p')
             ->andWhere('p.state = :state')
            ->setParameter('state', 1)
            ->select('COUNT(p.id) AS total_pacientes')
            ->getQuery()
            ->getSingleScalarResult()

        ;
    }

    public function getPhoto($id){
        return $this->createQueryBuilder('p')
            ->andWhere('p.state = :state')
            ->setParameter('state', 1)
            ->andWhere('p.id = :id')
            ->setParameter('id', $id)
            ->select('p.photo AS photo')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
}
