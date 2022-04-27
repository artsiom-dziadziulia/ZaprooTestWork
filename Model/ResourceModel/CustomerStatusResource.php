<?php
declare(strict_types=1);

namespace Zaproo\TestWork\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Zaproo\TestWork\Api\Data\CustomerStatusInterface;

class CustomerStatusResource extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'customer_status_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('zaproo_customer_status', CustomerStatusInterface::ID);
        $this->_useIsObjectNew = true;
    }
}
