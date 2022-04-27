<?php
declare(strict_types=1);

namespace Zaproo\TestWork\Block;

use Magento\Framework\View\Element\Template;

class CustomerStatus extends Template
{

    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }
}

