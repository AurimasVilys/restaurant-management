<?php

namespace App\Repository;

use App\Entity\Restaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Restaurant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Restaurant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Restaurant[]    findAll()
 * @method Restaurant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestaurantRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Restaurant::class);
    }


    /**
     * @param string|null $title
     * @param int $page
     * @param int $limit
     * @return Paginator
     */
    public function findActiveRestaurants(?string $title, int $page = 1, int $limit = 5)
    {
        $query = $this->createQueryBuilder('restaurant');
        $query->addSelect('COUNT(tables.id) AS TableCount')
            ->leftJoin('restaurant.tables', 'tables', 'WITH', 'tables.active = 1')
            ->groupBy('restaurant');
        if ($title) {
            $query->andWhere($query->expr()->like('restaurant.title', ':title'))
                ->setParameter('title', '%' . $title . '%');
        }

        $query->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);

        $paginator = new Paginator($query->getQuery());

        return $paginator;
    }
}
