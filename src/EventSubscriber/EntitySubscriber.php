<?php

namespace App\EventSubscriber;

use App\Entity\Osoby;
use App\Repository\OsobyRepository;
use Doctrine\ORM\Events;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\EntityManager;

class EntitySubscriber implements EventSubscriberInterface
{
    private $passwordHasher;
    
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::preUpdate => 'preUpdate',
        ];
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof Osoby) {
            $meta = $args->getEntityManager()->getClassMetadata(get_class($entity));

            if (!empty($entity->getPlainPassword())) {
                $newPassword = $this->passwordHasher->hashPassword($entity, $entity->getPlainPassword());
                $property = $meta->getReflectionProperty('password');
                $property->setValue($entity,$newPassword);
            }
            
            $property = $meta->getReflectionProperty('data_aktualizacji_wpisu');
            $property->setValue($entity,new \DateTime());

        }
    }
}
