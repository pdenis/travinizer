<?php


namespace Travinizer\Bundle\RepoBundle\Model;

use Travinizer\Bundle\RepoBundle\Entity\Repo as BaseRepo;
/**
 * Class Repo
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class Repo extends BaseRepo
{
    protected $owner;

    public function getOwner()
    {
        return $this->owner;
    }
}