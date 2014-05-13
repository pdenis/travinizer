<?php

namespace Travinizer\Bundle\RepoBundle\Loader;

use Travinizer\Bundle\UserBundle\Entity\User;


/**
 * Interface OsrcLoaderInterface
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
interface OsrcLoaderInterface
{
    /**
     * Load Osrc infos for a user
     *
     * @param User $user
     * @return User
     */
    public function load(User $user);
}
