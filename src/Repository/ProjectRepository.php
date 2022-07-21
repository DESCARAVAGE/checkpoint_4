<?php

namespace App\Repository;

use App\Entity\Project;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Projects>
 *
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    public function add(Project $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Project $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllPastEvents(DateTime $dateTime): array|false
    {
        return $this->createQueryBuilder('p')
            ->Where('p.date < :date_end')
            ->setParameter('date_end', $dateTime->format('01/03/2022'))
            ->OrderBy('p.date', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findAllUpcomingEvents(DateTime $dateTime): array|false
    {
        return $this->createQueryBuilder('p')
            ->Where('p.date > :date_start')
            ->setParameter('date_start', $dateTime->format('d/m/Y 01/03/2022'))
            ->OrderBy('p.date', 'ASC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Projects[] Returns an array of Projects objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Projects
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
