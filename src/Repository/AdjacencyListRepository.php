<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Entity\AdjacencyList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method null|AdjacencyList find($id, $lockMode = null, $lockVersion = null)
 * @method null|AdjacencyList findOneBy(array $criteria, array $orderBy = null)
 * @method AdjacencyList[]    findAll()
 * @method AdjacencyList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdjacencyListRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AdjacencyList::class);
    }

    // /**
    //  * @return Country[] Returns an array of Country objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
     */

    /*
    public function findOneBySomeField($value): ?Country
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
     */
}
