<?php
declare(strict_types=1);

namespace Zaproo\TestWork\Controller\Customer;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\Controller\Result\ForwardFactory;

class Status implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @var CustomerSession
     */
    private $customerSession;

    /**
     * @var ForwardFactory
     */
    private $forwardFactory;

    public function __construct(
        PageFactory $pageFactory,
        CustomerSession $customerSession,
        ForwardFactory $forwardFactory
    ) {
        $this->pageFactory = $pageFactory;
        $this->customerSession = $customerSession;
        $this->forwardFactory = $forwardFactory;
    }

    /**
     * @return \Magento\Framework\Controller\Result\Forward|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        if (!$this->getCustomerId()) {
            return $this->forwardFactory->create()->forward('noroute');
        }
        $page = $this->pageFactory->create();
        $page->getConfig()->getTitle()->set('Customer Status');

        return $page;

    }

    /**
     * Retrieve customer data object
     *
     * @return int
     */
    protected function getCustomerId(): int
    {
        return (int)$this->customerSession->getCustomerId();
    }
}
