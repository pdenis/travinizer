<?php

namespace Travinizer\Bundle\RepoBundle\Form\Type;

use FOS\UserBundle\Form\DataTransformer\UserToUsernameTransformer;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class UserType
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class UserType extends AbstractType
{
    /**
     * Repo Class model
     *
     * @var string
     */
    protected $repoClass;

    /**
     * User Class model
     *
     * @var string
     */
    protected $userClass;

    /**
     * @var UserManagerInterface
     */
    protected $userManager;

    /**
     * Constructor
     *
     * @param $class
     */
    public function __construct(UserManagerInterface $userManager, $repoClass, $userClass)
    {
        $this->userManager = $userManager;
        $this->repoClass = $repoClass;
        $this->userClass = $userClass;
    }

    /**
     * Build form
     *
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden');
        $builder->add('users', 'genemu_jqueryselect2_entity',array(
            'class' => $this->userClass,
            'choices' => $this->userManager->findUsers(),
            'multiple' => true,
            'configs' => array(
                'closeOnSelect' => false,
                'placeholder' => 'Search for a user',
                'allowClear' => false,
                'minimumInputLength' => 1
            )
        ));
    }

    /**
     * Get form default options
     *
     * @param array $options
     * @return array Form options
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => $this->repoClass,
        );
    }

    /**
     * Get form name
     * @return string Form name
     */
    public function getName()
    {
        return 'travinizer_user_type';
    }
}
