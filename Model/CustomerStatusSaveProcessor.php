<?php
declare(strict_types=1);

namespace Zaproo\TestWork\Model;

use Zaproo\TestWork\Model\Command\CustomerStatus\GetCommand;
use Zaproo\TestWork\Model\Command\CustomerStatus\SaveCommand;

class CustomerStatusSaveProcessor
{
    /**
     * @var GetCommand
     */
    private $getCommand;

    /**
     * @var SaveCommand
     */
    private $saveCommand;

    /**
     * @var CustomerStatusModelFactory
     */
    private $customerStatusModelFactory;

    public function __construct(
        GetCommand $getCommand,
        SaveCommand $saveCommand,
        CustomerStatusModelFactory $customerStatusModelFactory
    ) {
        $this->getCommand = $getCommand;
        $this->saveCommand = $saveCommand;
        $this->customerStatusModelFactory = $customerStatusModelFactory;
    }

    /**
     * @param int $customerId
     * @param string $value
     * @return int
     */
    public function process(int $customerId, string $value)
    {
        $dataForSave = ['status' => $value, 'customer_id' => $customerId];

        $customerStatusModel = $this->getCommand->getByCustomerId($customerId);
        if (!$customerStatusModel) {
            $customerStatusModel = $this->customerStatusModelFactory->create();
        }
        $customerStatusModel->addData($dataForSave);

        return $this->saveCommand->execute($customerStatusModel);
    }
}