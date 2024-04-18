<?php

namespace App\Repository;

use App\Entity\HorraireZoo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HorraireZoo>
 *
 * @method HorraireZoo|null find($id, $lockMode = null, $lockVersion = null)
 * @method HorraireZoo|null findOneBy(array $criteria, array $orderBy = null)
 * @method HorraireZoo[]    findAll()
 * @method HorraireZoo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HorraireZooRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HorraireZoo::class);
    }

//    /**
//     * @return HorraireZoo[] Returns an array of HorraireZoo objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?HorraireZoo
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
