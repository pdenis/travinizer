<?php

namespace Travinizer\Bundle\RepoBundle\Repository\Doctrine\Orm;

use Doctrine\Common\Collections\ArrayCollection;
use Snide\Bundle\TravinizerBundle\Repository\Doctrine\Orm\RepoRepository as BaseRepoRepository;
use Travinizer\Bundle\UserBundle\Entity\User;

/**
 * Class RepoRepository
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class RepoRepository extends BaseRepoRepository
{
    /**
     * Find all repos by user
     *
     * @param User $user
     */
    public function findAllByUser(User $user)
    {
        $qb = $this->createQueryBuilder('r');
        $qb->join('r.users', 'u')
            ->where($qb->expr()->eq('u.id', $user->getId()));
        return new ArrayCollection($qb->getQuery()->getResult());
    }
}