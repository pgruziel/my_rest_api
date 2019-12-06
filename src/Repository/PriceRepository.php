<?php

namespace App\Repository;

use App\Entity\Price;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Price|null find($id, $lockMode = null, $lockVersion = null)
 * @method Price|null findOneBy(array $criteria, array $orderBy = null)
 * @method Price[]    findAll()
 * @method Price[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PriceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Price::class);
    }

    public function findOneByProductAndCountry(int $productId, int $countryId): ?Price
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.product_id = :product_id')
            ->andWhere('p.country_id = :country_id')
            ->setParameter('product_id', $productId)
            ->setParameter('country_id', $countryId)
            ->getQuery()
            ->getOneOrNullResult()
            ;
        return null;
    }
}
