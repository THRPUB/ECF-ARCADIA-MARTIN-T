<?php

namespace App\Repository;

use App\Entity\Pagecontact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pagecontact>
 *
 * @method Pagecontact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pagecontact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pagecontact[]    findAll()
 * @method Pagecontact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PagecontactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pagecontact::class);
    }

//    /**
//     * @return Pagecontact[] Returns an array of Pagecontact objects
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

//    public function findOneBySomeField($value): ?Pagecontact
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
