<?php


namespace Travinizer\Bundle\RepoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DashController
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class DashController extends Controller
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

    /**
     * Get Repo manager
     *
     * @return mixed
     */
    protected function getManager()
    {
        return $this->get('snide_travinizer.repo_manager');
    }
}