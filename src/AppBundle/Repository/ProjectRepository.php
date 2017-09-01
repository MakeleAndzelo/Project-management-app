<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class ProjectRepository extends EntityRepository
{
    public function findAllLoggedUserProjectsOrderByDeadline(User $user)
    {
        return $this->createQueryBuilder('projects')
            ->leftJoin('projects.users', 'users')
            ->andWhere('users.id = :userId')
            ->setParameter('userId', $user->getId())
            ->orderBy('projects.deadline', 'DESC')
            ->getQuery();
    }
}