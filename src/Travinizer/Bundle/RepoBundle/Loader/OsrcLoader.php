<?php


namespace Travinizer\Bundle\RepoBundle\Loader;

use Snide\Osrc\Client;
use Travinizer\Bundle\UserBundle\Entity\User;


/**
 * Class OsrcLoader
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class OsrcLoader implements OsrcLoaderInterface
{
    /**
     * Osrc API client
     *
     * @var Client
     */
    protected $client;

    /**
     * Constructor
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Load Osrc infos for a user
     *
     * @param User $user
     * @return User
     */
    public function load(User $user)
    {
        $osrcUser = new \Snide\Osrc\Model\User($user->getUsername());
        $osrcUser = $this->client->fetchUser($osrcUser);
        // @TODO : Store osrc infos into user

        return $user;
    }
}
