<?php


namespace Travinizer\Bundle\RepoBundle\Doctrine\Orm;

use Doctrine\Common\EventSubscriber;;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Travinizer\Bundle\RepoBundle\Entity\Repo;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

/**
 * Class RepoListener
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class RepoListener implements EventSubscriber
{
    /**
     * Security Context
     *
     * @var SecurityContextInterface $securityContext
     */
    protected $securityContext;

    /**
     * Constructor
     *
     * @param SecurityContextInterface $securityContext
     */
    public function __construct(SecurityContextInterface $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    /**
     * {@inheritDoc}
     */
    public function getSubscribedEvents()
    {
        return array(
            Events::prePersist,
            Events::preUpdate,
        );
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist($args)
    {
        $object = $args->getEntity();
        if ($object instanceof Repo) {
            $this->updateUser($object);
        }
    }

    /**
     * @param PreUpdateEventArgs $args
     */
    public function preUpdate($args)
    {
        $object = $args->getEntity();
        if ($object instanceof Repo) {
            $this->updateUser($object);
        }
    }

    /**
     * Update repository user
     *
     * @param Repo $repo
     */
    public function updateUser(Repo $repo)
    {
        $repo->setUser($this->securityContext->getToken()->getUser());
    }
}
