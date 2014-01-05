<?php

namespace Travinizer\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class TravinizerUserBundle
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class TravinizerUserBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}