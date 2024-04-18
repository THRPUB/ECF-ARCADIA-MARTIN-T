<?php

namespace App\Repository;

use App\Entity\VisiteVeterinaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VisiteVeterinaire>
 *
 * @method VisiteVeterinaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method VisiteVeterinaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method VisiteVeterinaire[]    findAll()
 * @method VisiteVeterinaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisiteVeterinaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VisiteVeterinaire::class);
    }

//    /**
//     * @return VisiteVeterinaire[] Returns an array of VisiteVeterinaire objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VisiteVeterinaire
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
