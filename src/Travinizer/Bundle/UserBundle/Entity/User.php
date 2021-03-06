<?php


namespace Travinizer\Bundle\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
use Travinizer\Bundle\RepoBundle\Entity\Repo;

/**
 * Class User
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 *
 * @ORM\Entity
 * @ORM\Table(name="travinizer_user")
 *
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="User", mappedBy="users", cascade={"persist"})
     * @ORM\JoinTable(name="users_repos")
     */
    protected $repos;

    /**
     * Add a repo
     *
     * @param Repo $repo
     */
    public function addRepo(Repo $repo)
    {
        if(!$this->getRepos()->contains($repo)) {
            $this->getRepos()->add($repo);
        }
    }

    /**
     * Get repos
     *
     * @return ArrayCollection
     */
    public function getRepos()
    {
        if(!$this->repos) {
            $this->repos = new ArrayCollection();
        }
        return $this->repos;
    }

    /**
     * Remove repo
     *
     * @param Repo $repo
     */
    public function removeRepo(Repo $repo)
    {
        $this->getRepos()->removeElement($repo);
    }

    /**
     * Set repos
     *
     * @param ArrayCollection $repos
     */
    public function setRepos(ArrayCollection $repos)
    {
        $this->repos = $repos;
    }
}