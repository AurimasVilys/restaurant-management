<?php

namespace App\Repository;

use App\Entity\Restaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
     * @return mixed
     */
    public function findActiveRestaurants(?string $title)
    {
        $query = $this->createQueryBuilder('restaurant');
        $query->addSelect('COUNT(tables.id) AS Count')
            ->leftJoin('restaurant.tables', 'tables', 'WITH', 'tables.active = 1')
            ->where('restaurant.active = 1')
            ->groupBy('restaurant');
        if ($title) {
            $query->andWhere($query->expr()->like('restaurant.title', ':title'))
                ->setParameter('title', '%' . $title . '%');
        }
        return $query->getQuery()->getResult();
    }
}
