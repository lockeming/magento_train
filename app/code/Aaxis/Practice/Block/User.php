<?php


namespace Aaxis\Practice\Block;

use Magento\Framework\View\Element\Template;
use Magento\User\Model\ResourceModel\User as UserResource;
use Magento\User\Model\UserFactory;

class User extends Template
{
    /**
     * @var UserFactory
     */
    protected $userFactory;

    /**
     * @var UserResource
     */
    protected $userResource;

    public function __construct(
        Template\Context $context,
        $userFactory,
        $userResource,
        array $data = []
    )
    {
        $this->$userFactory = $userFactory;
        $this->userResource = $userResource;
        parent::__construct($context, $data);
    }

    public function getUser()
    {
        $email = $this->_request->getParam('email');
        if (empty($email)) {
            return null;
        }
        $user = $this->userFactory->create();
        $this->userResource->load($user,$email,'email');
        return $user;
    }
}
