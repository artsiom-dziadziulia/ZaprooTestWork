<?php
declare(strict_types=1);

namespace Zaproo\TestWork\Controller\Customer;

use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Forward;
use Magento\Framework\Controller\Result\ForwardFactory;
use Zaproo\TestWork\Model\CustomerStatusSaveProcessor;

class StatusSave implements HttpPostActionInterface
{
    /**
     * @var ForwardFactory
     */
    private $forwardFactory;

    /**
     * @var CustomerSession
     */
    private $customerSession;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var CustomerStatusSaveProcessor
     */
    private $customerStatusSaveProcessor;

    public function __construct(
        ForwardFactory $forwardFactory,
        CustomerSession $customerSession,
        RequestInterface $request,
        CustomerStatusSaveProcessor $customerStatusSaveProcessor
    ) {
        $this->forwardFactory = $forwardFactory;
        $this->customerSession = $customerSession;
        $this->request = $request;
        $this->customerStatusSaveProcessor = $customerStatusSaveProcessor;
    }

    /**
     * @return Forward
     */
    public function execute()
    {
        if (!$this->getCustomerId()) {
            return $this->forwardFactory->create()->forward('noroute');
        }

        $data = $this->request->getPostValue();

        if (!empty($data['status'])) {
            $this->customerStatusSaveProcessor->process($this->getCustomerId(), $data['status']);
        }

        return $this->forwardFactory->create()->forward('status');
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
