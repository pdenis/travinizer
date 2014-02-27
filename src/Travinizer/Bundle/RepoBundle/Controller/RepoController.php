<?php


namespace Travinizer\Bundle\RepoBundle\Controller;

use Snide\Bundle\TravinizerBundle\Controller\RepoController as BaseRepoController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Snide\Bundle\TravinizerBundle\Model\Repo;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    public function updateAction(Repo $repo)
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

    /**
     * Update users
     *
     * @param Repo $repo
     * @return array|RedirectResponse
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     */
    public function updateUserAction(Repo $repo)
    {
        if (!$this->get('security.context')->isGranted('OWNER', $repo)) {
            throw new AccessDeniedException();
        }

        $form = $this->getUserForm($repo);
        $slug = $repo->getSlug();
        $form->handleRequest($this->get('request'));
        $repo = $form->getData();
        if ($form->isValid()) {
            // Save instance

            $this->getManager()->update($repo);
            $this->get('session')->getFlashBag()->add('success', 'Repository updated successfully');

            return new RedirectResponse($this->generateUrl('snide_travinizer_dashboard'));
        }
        $this->get('session')->getFlashBag()->add('error', 'Some errors found');

        return array(
            'form' => $form->createView(),
            'repo' => $repo
        );
    }

    /**
     * @param Repo $repo
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     *
     * @Template
     */
    public function editUserAction(Repo $repo)
    {
        if (!$this->get('security.context')->isGranted('OWNER', $repo)) {
            throw new AccessDeniedException();
        }

        $form = $this->getUserForm($repo);

        return array(
            'form' => $form->createView(),
            'repo' => $repo
        );
    }

    /**
     * Create user Form and submit it with repo instance
     *
     * @param Repo $repo
     * @return \Symfony\Component\Form\Form
     */
    protected function getUserForm($repo = null)
    {
        if ($repo == null) {
            $repo = $this->getManager()->createNew();
        }

        return $this->createForm(
            $this->container->get('travinizer_repo.form.user_type'),
            $repo
        );
    }
}