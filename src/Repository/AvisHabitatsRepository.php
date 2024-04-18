<?php

namespace App\Repository;

use App\Entity\AvisHabitats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AvisHabitats>
 *
 * @method AvisHabitats|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvisHabitats|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvisHabitats[]    findAll()
 * @method AvisHabitats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvisHabitatsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AvisHabitats::class);
    }

//    /**
//     * @return AvisHabitats[] Returns an array of AvisHabitats objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AvisHabitats
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
