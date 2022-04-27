<?php
declare(strict_types=1);

namespace Zaproo\TestWork\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;
use Magento\Customer\Model\SessionFactory as CustomerSessionFactory;
use Magento\Framework\DataObject;
use Zaproo\TestWork\Model\Command\CustomerStatus\GetCommand;

class Status extends DataObject implements SectionSourceInterface
{
    /**
     * @var CustomerSessionFactory
     */
    private $sessionFactory;

    /**
     * @var GetCommand
     */
    private $getCommand;

    public function __construct(
        CustomerSessionFactory $sessionFactory,
        GetCommand $getCommand,
        array $data = []
    ) {
        parent::__construct($data);
        $this->sessionFactory = $sessionFactory;
        $this->getCommand = $getCommand;
    }

    public function getSectionData(): array
    {
        $result = [
            'status' => ''
        ];
        $customerId = (int)$this->sessionFactory->create()->getCustomerId();

        if ($customerId) {
            $result['status'] = $this->getCommand->getByCustomerId($customerId)->getStatus();
        }

        return $result;
    }
}
