<?php

namespace App\Repository;

use App\Entity\DiffusionPartner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DiffusionPartner>
 *
 * @method DiffusionPartner|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiffusionPartner|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiffusionPartner[]    findAll()
 * @method DiffusionPartner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiffusionPartnerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DiffusionPartner::class);
    }

    public function save(DiffusionPartner $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DiffusionPartner $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return DiffusionPartner[] Returns an array of DiffusionPartner objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DiffusionPartner
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
