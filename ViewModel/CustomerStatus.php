<?php
declare(strict_types=1);

namespace Zaproo\TestWork\ViewModel;

use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Zaproo\TestWork\Model\Command\CustomerStatus\GetCommand;

class CustomerStatus implements ArgumentInterface
{
    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    /**
     * @var CustomerSession
     */
    private $customerSession;

    /**
     * @var GetCommand
     */
    private $getCommand;

    public function __construct(
        UrlInterface $urlBuilder,
        CustomerSession $customerSession,
        GetCommand $getCommand
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->customerSession = $customerSession;
        $this->getCommand = $getCommand;
    }

    public function getStatus(): string
    {
        $status = $this->getCommand->getByCustomerId((int)$this->customerSession->getId())->getStatus();

        if ($status) {
            return $status;
        }

        return '';
    }

    /**
     * @return string
     */
    public function getFormAction(): string
    {
        return $this->urlBuilder->getUrl('zaproo/customer/statusSave');
    }
}
