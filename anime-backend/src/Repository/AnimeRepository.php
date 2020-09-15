<?php

namespace App\Repository;

use App\Entity\Anime;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Image;
use App\Entity\InterAction;
use App\Entity\Rating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Anime|null find($id, $lockMode = null, $lockVersion = null)
 * @method Anime|null findOneBy(array $criteria, array $orderBy = null)
 * @method Anime[]    findAll()
 * @method Anime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Anime::class);
    }

    // /**
    //  * @return Anime[] Returns an array of Anime objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Anime
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getAll()
    {
        $res = $this->createQueryBuilder('anime')
            ->select('anime.id', 'anime.name', 'img.image as mainImage',
                'count(DISTINCT inter.type) as countInteraction','avg(rate.rateValue) as rating',
                'count(DISTINCT c.comment) as comments')
            ->leftJoin(
                Image::class,                    //Entity
                'img',                          //Alias
                Join::WITH,              //Join Type
                'img.animeID = anime.id'    //Join Column
            )
            ->leftJoin(
                InterAction::class,              //Entity
                'inter',                        //Alias
                Join::WITH,              //Join Type
                'inter.animeId = anime.id'  //Join Column
            )
            ->leftJoin(
                Rating::class,                   //Entity
                'rate',                         //Alias
                Join::WITH,              //Join Type
                'rate.animeId = anime.id'   //Join Column
            )
            ->leftJoin(
                Comment::class,                  //Entity
                'c',                            //Alias
                Join::WITH,              //Join Type
                'c.animeId = anime.id'      //Join Column
            )
            ->groupBy('anime.id')
            ->getQuery()
            ->getResult();

        return $res;
    }

    public function getAnimeById($id): ?Anime
    {
        $res = $this->createQueryBuilder('anime')
            ->andWhere('anime.id=:id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();

        return $res;
    }
    
    public function getAnimeByCategoryId($catId)
    {
        $res = $this->createQueryBuilder('anime')
            ->andWhere('anime.categoryID=:catId')
            ->setParameter('catId', $catId)
            ->getQuery()
            ->getResult();
        
        return $res;
    }
}
