<?php

namespace App\Repository;

use App\Entity\Restaurant;
use App\Entity\Table;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Table|null find($id, $lockMode = null, $lockVersion = null)
 * @method Table|null findOneBy(array $criteria, array $orderBy = null)
 * @method Table[]    findAll()
 * @method Table[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TableRepository extends ServiceEntityRepository
{
    /**
     * TableRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Table::class);
    }

    /**
     * @param Restaurant $restaurant
     * @return Paginator
     */
    public function findByRestaurant(Restaurant $restaurant, int $page = 1, int $limit = 5)
    {
        $query = $this->createQueryBuilder('table');

         $query->where('table.restaurant = :restaurant')
            ->setParameter('restaurant', $restaurant)
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);

        $paginator = new Paginator($query->getQuery());

        return $paginator;
    }
}
