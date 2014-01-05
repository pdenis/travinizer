<?php

namespace Travinizer\Bundle\RepoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class TravinizerRepoBundle
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class TravinizerRepoBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'SnideTravinizerBundle';
    }
}
