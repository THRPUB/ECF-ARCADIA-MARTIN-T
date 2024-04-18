<?php

namespace App\Repository;

use App\Entity\PassageEmploye;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PassageEmploye>
 *
 * @method PassageEmploye|null find($id, $lockMode = null, $lockVersion = null)
 * @method PassageEmploye|null findOneBy(array $criteria, array $orderBy = null)
 * @method PassageEmploye[]    findAll()
 * @method PassageEmploye[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PassageEmployeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PassageEmploye::class);
    }

//    /**
//     * @return PassageEmploye[] Returns an array of PassageEmploye objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PassageEmploye
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
