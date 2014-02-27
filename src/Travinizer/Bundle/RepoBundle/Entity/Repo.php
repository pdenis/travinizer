<?php

namespace Travinizer\Bundle\RepoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Snide\Bundle\TravinizerBundle\Entity\Repo as BaseRepo;
use Travinizer\Bundle\UserBundle\Entity\User;

/**
 * Class Repo
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 *
 * @ORM\Entity(repositoryClass="Travinizer\Bundle\RepoBundle\Repository\Doctrine\Orm\RepoRepository")
 * @ORM\Table(name="travinizer_repo")
 */
class Repo extends BaseRepo
{
    /**
     * @ORM\ManyToMany(targetEntity="Travinizer\Bundle\UserBundle\Entity\User", inversedBy="repos")
     */
    protected $users;

    /**
     * Add a user to the list
     *
     * @param User $user
     */
    public function addUser(User $user)
    {
        $this->getUsers()->add($user);
    }

    /**
     * Get users
     *
     * @return ArrayCollection
     */
    public function getUsers()
    {
        if(!$this->users) {
            $this->users = new ArrayCollection();
        }
        return $this->users;
    }

    /**
     * Remove a user from the list
     *
     * @param User $user
     */
    public function removeUser(User $user)
    {
        if($this->getUsers()->contains($user)) {
            $this->getUsers()->removeElement($user);
        }
    }

    /**
     * Set users
     *
     * @param ArrayCollection $users
     */
    public function setUsers(ArrayCollection $users)
    {
        $this->users = $users;
    }
}

