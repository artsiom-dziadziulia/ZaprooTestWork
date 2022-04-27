<?php
declare(strict_types=1);

namespace Zaproo\TestWork\Plugin\Customer\Adminhtml\DataProvider;

use Magento\Customer\Model\Customer\DataProviderWithDefaultAddresses;
use Zaproo\TestWork\Model\Command\CustomerStatus\GetCommand;

class LoadCustomerStatus
{
    /**
     * @var GetCommand
     */
    private $getCommand;

    public function __construct(GetCommand $getCommand)
    {
        $this->getCommand = $getCommand;
    }

    /**
     * @param DataProviderWithDefaultAddresses $subject
     * @param array $result
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function afterGetData(DataProviderWithDefaultAddresses $subject, array $result): array
    {
        foreach ($result as $id => $entityData) {
            if ($id) {
                if (!empty($entityData['customer']['entity_id'])) {
                    $customerStatus = $this->getCommand->getByCustomerId((int)$entityData['customer']['entity_id']);
                    $customerStatusDataToInsert[$id]['customer']['customer_status'] = $customerStatus->getStatus();
                }
            }
        }

        return array_replace_recursive($result, $customerStatusDataToInsert);
    }
}