<?php
declare(strict_types=1);

namespace Zaproo\TestWork\Model;

use Magento\Framework\Model\AbstractModel;
use Zaproo\TestWork\Api\Data\CustomerStatusInterface;
use Zaproo\TestWork\Model\ResourceModel\CustomerStatusResource;

class CustomerStatusModel extends AbstractModel implements CustomerStatusInterface
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'customer_status_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(CustomerStatusResource::class);
    }

    /**
     * Getter for CustomerId.
     *
     * @return int|null
     */
    public function getCustomerId(): ?int
    {
        return ($this->getData(self::CUSTOMER_ID) === null) ? null
            : (int)$this->getData(self::CUSTOMER_ID);
    }

    /**
     * Setter for CustomerId.
     *
     * @param int|null $customerId
     *
     * @return void
     */
    public function setCustomerId(?int $customerId): void
    {
        $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * Getter for Status.
     *
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Setter for Status.
     *
     * @param string|null $status
     *
     * @return void
     */
    public function setStatus(?string $status): void
    {
        $this->setData(self::STATUS, $status);
    }
}
