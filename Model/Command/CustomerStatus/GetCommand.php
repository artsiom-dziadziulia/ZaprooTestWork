<?php
declare(strict_types=1);

namespace Zaproo\TestWork\Model\Command\CustomerStatus;

use Magento\Framework\Exception\NoSuchEntityException;
use Zaproo\TestWork\Api\Data\CustomerStatusInterface;
use Zaproo\TestWork\Model\CustomerStatusModelFactory;
use Zaproo\TestWork\Model\ResourceModel\CustomerStatusResource;

class GetCommand
{
    /**
     * @var CustomerStatusInterface[]
     */
    protected $storageByOrder = [];

    /**
     * @var CustomerStatusResource
     */
    private $customerStatusResource;

    /**
     * @var CustomerStatusModelFactory
     */
    private $customerStatusModelFactory;

    public function __construct(
        CustomerStatusResource $customerStatusResource,
        CustomerStatusModelFactory $customerStatusModelFactory
    ) {
        $this->customerStatusResource = $customerStatusResource;
        $this->customerStatusModelFactory = $customerStatusModelFactory;
    }

    /**
     * @param int $customerId
     *
     * @return CustomerStatusInterface
     * @throws NoSuchEntityException
     */
    public function getByCustomerId(int $customerId): CustomerStatusInterface
    {
        if (!isset($this->storageByOrder[$customerId])) {
            /** @var CustomerStatusInterface $model */
            $model = $this->customerStatusModelFactory->create();
            $this->customerStatusResource->load($model, $customerId, CustomerStatusInterface::CUSTOMER_ID);
            $this->storageByOrder[$customerId] = $model;
        }

        return $this->storageByOrder[$customerId];
    }
}
