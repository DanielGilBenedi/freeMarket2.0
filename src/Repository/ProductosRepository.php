<?php

namespace App\Repository;

use App\Entity\Productos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Productos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Productos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Productos[]    findAll()
 * @method Productos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Productos::class);
    }
    /**
     * @return Productos[] Returns an array of Productos objects
     */
    public function getProductosByCat($id){

        return $this->createQueryBuilder('c')
            ->andWhere('c.id_categoria = :val')
            ->setParameter('val', $id)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;


    }


    /**
     * @return Productos[] Returns an array of Productos objects
     */
    public function getProductosByMarc($id){

        return $this->createQueryBuilder('c')
            ->andWhere('c.id_marca = :val')
            ->setParameter('val', $id)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;


    }



    public function searchProd($value)
    {
        return $this->createQueryBuilder('p')
            ->where('p.nombre = :val')
            ->setParameter('val','%'.$value.'%')
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Productos[] Returns an array of Productos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Productos
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
