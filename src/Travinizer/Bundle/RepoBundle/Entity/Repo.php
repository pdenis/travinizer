<?php

namespace Travinizer\Bundle\RepoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Snide\Bundle\TravinizerBundle\Entity\Repo as BaseRepo;
use Travinizer\Bundle\UserBundle\Entity\User;

/**
 * Class Repo
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 *
 * @ORM\Entity(repositoryClass="Snide\Bundle\TravinizerBundle\Repository\Doctrine\Orm\RepoRepository")
 * @ORM\Table(name="travinizer_repo")
 */
class Repo extends BaseRepo
{
    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Travinizer\Bundle\UserBundle\Entity\User")
     */
    protected $owner;

    /**
     * Getter owner
     *
     * @return User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Setter owner
     *
     * @param User $owner
     */
    public function setOwner(User $owner)
    {
        $this->owner = $owner;
    }

}
