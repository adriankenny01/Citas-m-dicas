<?php

namespace App\Repository;

use App\Entity\Medic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Medic|null find($id, $lockMode = null, $lockVersion = null)
 * @method Medic|null findOneBy(array $criteria, array $orderBy = null)
 * @method Medic[]    findAll()
 * @method Medic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Medic::class);
    }

    // /**
    //  * @return Medic[] Returns an array of Medic objects
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
    public function findOneBySomeField($value): ?Medic
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function countAll()
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.state = :state')
            ->setParameter('state', 1)
            ->select('COUNT(m.id) AS total_medicos')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function showMedic(int $medic_id){
        
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT 
                    m.id,
                    m.name,
                    m.last_name,
                    m.address,
                    m.phone,
                    m.province,
                    m.social_security,
                    m.number_of_collegiate,
                    g.name AS 'grupo',
                    m.image,
                    m.date_start,
                    m.date_end,
                    c.area AS 'area_medica',
                    m.card_id,
                    CONCAT(s.day_one, ' - ', s.from_hour_day_one ,' a ', s.to_hour_day_one, ' ', s.day_two, ' - ', s.from_hour_day_two, ' a ', s.to_hour_day_two )
                        AS 'horario'
                FROM medic AS m
                    LEFT JOIN medic_group AS g ON m.group_id = g.id
                LEFT JOIN category AS c ON m.category_id = c.id
                    LEFT JOIN schedule AS s ON m.schedule_id = s.id
                    WHERE m.state = 1 AND m.id =  :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue('id', $medic_id);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
