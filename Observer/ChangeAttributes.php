<?php
declare(strict_types=1);

namespace Zaproo\TestWork\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Zaproo\TestWork\Model\CustomerStatusSaveProcessor;

class ChangeAttributes implements ObserverInterface
{
    /**
     * @var CustomerStatusSaveProcessor
     */
    private $customerStatusSaveProcessor;

    public function __construct(CustomerStatusSaveProcessor $customerStatusSaveProcessor)
    {
        $this->customerStatusSaveProcessor = $customerStatusSaveProcessor;
    }

    public function execute(Observer $observer)
    {
        $requestData = $observer->getRequest()->getParam('customer');
        if (!empty($requestData['customer_status']) && !empty($requestData['entity_id'])) {
            $this->customerStatusSaveProcessor->process(
                (int)$requestData['entity_id'], $requestData['customer_status']
            );
        }
    }
}
