<?php

namespace App\Repository;

use App\Entity\Commande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Commande>
 *
 * @method Commande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande[]    findAll()
 * @method Commande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
    }

    public function save(Commande $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Commande $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

// "SELECT id_vehicule, ville, titre_vehicule, marque_vehicule, modele_vehicule, description_vehicule, photo_vehicule, prix_journalier 
//      FROM vehicule 
//      INNER JOIN agences 
//      ON agences.id_agence = vehicule.id_agence;" 

public function findAllCommande()
{
    return $this->createQueryBuilder('c')
            ->Select('v.id','v.titre','v.marque','v.modele','v.description','v.photo','v.prix_journalier','a.id', 'a.titre as titreAgences','a.adresse','a.ville','a.cp','a.description as descriptionAgences','a.photo as photoAgences','m.id','m.pseudo','m.nom','m.prenom','m.email','m.civilite','m.statut','m.date_enregistrement')
            ->innerJoin('App\Entity\Vehicule','v', Join::WITH, 'v.id = c.id_vehicule')            
            ->innerJoin('App\Entity\Agences', 'a' , Join::WITH, 'a.id = c.id_agence')
            ->innerJoin('App\Entity\Membre','m', Join::WITH, 'm.id = c.id_membre')
            ->getQuery()		
            ->getResult();
}

// public function findAllCommande()
// {
//     return $this->createQueryBuilder('c')
//             ->select('c')
//             ->getQuery()		
//             ->getResult();
// }



//    /**
//     * @return Commande[] Returns an array of Commande objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Commande
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
