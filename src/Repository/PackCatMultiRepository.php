<?php

namespace App\Repository;

use App\Entity\PackCatMulti;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PackCatMulti>
 *
 * @method PackCatMulti|null find($id, $lockMode = null, $lockVersion = null)
 * @method PackCatMulti|null findOneBy(array $criteria, array $orderBy = null)
 * @method PackCatMulti[]    findAll()
 * @method PackCatMulti[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PackCatMultiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PackCatMulti::class);
    }

    public function add(PackCatMulti $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PackCatMulti $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PackCatMulti[] Returns an array of PackCatMulti objects
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

//    public function findOneBySomeField($value): ?PackCatMulti
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
