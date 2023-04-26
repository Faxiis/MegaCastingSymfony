<?php

namespace App\Repository;

use App\Entity\Offers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Offers>
 *
 * @method Offers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offers[]    findAll()
 * @method Offers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offers::class);
    }

    public function save(Offers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Offers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findSearch($query){
        return $this->createQueryBuilder('o')
            ->where('o.label LIKE :query')
            ->orWhere('o.reference LIKE :query')
            ->orWhere('o.localisation LIKE :query')
            //->join('o.activities', 'act')
            //->orWhere('act.name LIKE :query')
            ->setParameter('query', '%'.$query.'%')

            ->getQuery()
            ->getResult();
    }

    /**
     * @return Offers[] Returns an array of Offers objects
     */
    public function findByContractType($contrat, $activity, $level, $user): array
    {
        $query = $this
            ->createQueryBuilder('o')
            ->select('o', 'a')
            ->join('o.activities', 'a')
            ->where('o.contractTypes IN (:con) OR a IN (:act)')
            ->setParameter('con', $contrat)
            ->setParameter('act', $activity);

        if($level){
            $query = $query
                ->orWhere('o.profesionalLevel < :lev')
                ->setParameter('lev', $user)
                ->orderBy('o.status ', 'DESC');
        }

        return $query->getQuery()->getResult();

    }


//    public function findOneBySomeField($value): ?Offers
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
