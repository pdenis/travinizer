<?php


namespace Travinizer\Bundle\RepoBundle\Controller;

use Snide\Bundle\TravinizerBundle\Controller\RepoController as BaseRepoController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Snide\Bundle\TravinizerBundle\Model\Repo;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class RepoController
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class RepoController extends BaseRepoController
{
    /**
     * Update application action
     *
     * @param Request $request
     * @return array|RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @ParamConverter("repo", converter="snide_travinizer.repo_converter", class="Snide\Bundle\TravinizerBundle\Model\Repo")
     * @Template("SnideTravinizerBundle:Repo:edit.html.twig")
     */
    public function updateAction(Repoo $repo)
    {
        if (!$this->get('security.context')->isGranted('OWNER', $repo)) {
            throw new AccessDeniedException();
        }

        return parent::updateAction($repo);
    }

    /**
     * Delete application action
     *
     * @param \Snide\Bundle\TravinizerBundle\Model\Repo $repo
     * @return RedirectResponse
     *
     * @ParamConverter("repo", converter="snide_travinizer.repo_converter", class="Snide\Bundle\TravinizerBundle\Model\Repo")
     */
    public function deleteAction(Repo $repo)
    {
        if (!$this->get('security.context')->isGranted('OWNER', $repo)) {
            throw new AccessDeniedException();
        }

        return parent::deleteAction($repo);
    }

    /**
     * Edit repository  action
     *
     * @param \Snide\Bundle\TravinizerBundle\Model\Repo $repo
     * @return array|RedirectResponse
     *
     * @ParamConverter("repo", converter="snide_travinizer.repo_converter", class="Snide\Bundle\TravinizerBundle\Model\Repo")
     * @Template
     */
    public function editAction(Repo $repo = null)
    {
        if (!$this->get('security.context')->isGranted('OWNER', $repo)) {
            throw new AccessDeniedException();
        }

        return parent::editAction($repo);
    }
}