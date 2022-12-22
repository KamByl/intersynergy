<?php

namespace App\Repository;

use App\Entity\Osoby;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<Osoby>
 *
 * @method Osoby|null find($id, $lockMode = null, $lockVersion = null)
 * @method Osoby|null findOneBy(array $criteria, array $orderBy = null)
 * @method Osoby[]    findAll()
 * @method Osoby[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OsobyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Osoby::class);
    }

    public function add(Osoby $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Osoby $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllByNazwisko()
    {
        return $this->createQueryBuilder('q')
            ->orderBy('q.nazwisko', 'ASC');
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof Uzyt) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);

        $this->add($user, true);
    }

    //    /**
    //     * @return Osoby[] Returns an array of Osoby objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }
}
