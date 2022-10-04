<?php

namespace App\Repository;

use App\Entity\Recette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recette>
 *
 * @method Recette|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recette|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recette[]    findAll()
 * @method Recette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recette::class);
    }

    public function add(Recette $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Recette $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function recettesPatients($User){
        $tableauIdIngredients = array();
        foreach($User->getIdIngredient() as $ingredient ){
            $tableauIdIngredients[] = $ingredient->getId();
        }
        $tableauIdRegime = array();
        foreach($User->getIdRegime() as $regime){
            $tableauIdRegime[] = $regime->getId();
        }
        $qb = $this->createQueryBuilder('r');
        return $qb
            ->join('r.ingredientRecettes', 'ir')
            ->join('r.IdRegime', 'rr')
            ->andWhere($qb->expr()->notIn('ir.Ingredient', $tableauIdIngredients))
            ->andWhere($qb->expr()->in('rr.id', $tableauIdRegime))
            ->groupBy('r.id')
            ->getQuery()
            ->getResult();
    }

    public function recettesPubliques(){
        $qb = $this->createQueryBuilder('r');
        return $qb
                ->andWhere('r.RecettePublic = TRUE')
                ->orderBy('r.Title')
                ->getQuery()
                ->getResult();
    }

//    /**
//     * @return Recette[] Returns an array of Recette objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Recette
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
