<?php

namespace Travinizer\Bundle\RepoBundle\Manager;

use Snide\Bundle\TravinizerBundle\Loader\ScrutinizerLoaderInterface;
use Snide\Bundle\TravinizerBundle\Loader\TravisLoaderInterface;
use Snide\Bundle\TravinizerBundle\Manager\RepoManager as BaseRepoManager;
use Snide\Bundle\TravinizerBundle\Model\Repo;
use Snide\Bundle\TravinizerBundle\Reader\ComposerReaderInterface;
use Snide\Bundle\TravinizerBundle\Repository\RepoRepositoryInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Travinizer\Bundle\UserBundle\Entity\User;


/**
 * Class RepoManager
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class RepoManager extends BaseRepoManager
{
    /**
     * Security Context
     *
     * @var \Symfony\Component\Security\Core\SecurityContextInterface
     */
    protected $securityContext;

    /**
     * Constructor
     *
     * @param RepoRepositoryInterface $repository Repo repository
     * @param $class
     * @param \Snide\Bundle\TravinizerBundle\Loader\TravisLoaderInterface $travisLoader
     * @param \Snide\Bundle\TravinizerBundle\Loader\ScrutinizerLoaderInterface $scrutinizerLoader
     * @param ComposerReaderInterface $composerReader
     * @param \Symfony\Component\Security\Core\SecurityContextInterface $securityContext
     */
    public function __construct(
        RepoRepositoryInterface $repository,
        $class,
        TravisLoaderInterface $travisLoader,
        ScrutinizerLoaderInterface $scrutinizerLoader,
        ComposerReaderInterface $composerReader,
        SecurityContextInterface $securityContext
    ) {
        parent::__construct($repository, $class, $travisLoader, $scrutinizerLoader, $composerReader);
        $this->securityContext   = $securityContext;
    }

    /**
     * Create and save an repo
     *
     * @param Repo $repo
     */
    public function create(Repo $repo)
    {
        $this->updateUser($repo);
        parent::create($repo);
    }

    /**
     * Update an repo
     *
     * @param Repo $repo
     */
    public function update(Repo $repo)
    {
        $this->updateUser($repo);
        parent::update($repo);
    }


    public function findAllByUser(User $user)
    {
        $repositories = $this->repository->findBy(array('owner' => $user));
        $repos = array();
        foreach($repositories as $repo) {
            $this->loadPackagistInfos($repo);
            $repos[] = $repo;
        }

        return $repos;
    }

    protected function updateUser(\Travinizer\Bundle\RepoBundle\Entity\Repo $repo)
    {
        $repo->setOwner($this->securityContext->getToken()->getUser());
    }
}