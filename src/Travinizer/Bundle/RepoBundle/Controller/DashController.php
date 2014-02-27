<?php


namespace Travinizer\Bundle\RepoBundle\Controller;

use Snide\Bundle\TravinizerBundle\Controller\DashController as BaseController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DashController
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class DashController extends BaseController
{
    /**
     * Dashboard Action
     *
     * @return Response
     */
    public function indexAction()
    {
        if($this->getUser()) {

            $repositories = $this->getManager()->findAllByUser($this->getUser());

            return $this->render(
                'SnideTravinizerBundle:Dash:index.html.twig',
                array(
                    'repositories' => $repositories,
                )
            );
        }

        return $this->render(
            'TravinizerRepoBundle:Dash:home.html.twig',
            array()
        );

    }


}