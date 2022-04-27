<?php
declare(strict_types=1);

namespace Zaproo\TestWork\Model\ResourceModel\CustomerStatusModel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Zaproo\TestWork\Model\CustomerStatusModel;
use Zaproo\TestWork\Model\ResourceModel\CustomerStatusResource;

class CustomerStatusCollection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'customer_status_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(CustomerStatusModel::class, CustomerStatusResource::class);
    }
}
