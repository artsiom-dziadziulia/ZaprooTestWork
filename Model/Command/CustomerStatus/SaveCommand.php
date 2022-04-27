<?php
declare(strict_types=1);

namespace Zaproo\TestWork\Model\Command\CustomerStatus;

use Exception;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;
use Zaproo\TestWork\Api\Data\CustomerStatusInterface;
use Zaproo\TestWork\Model\CustomerStatusModel;
use Zaproo\TestWork\Model\CustomerStatusModelFactory;
use Zaproo\TestWork\Model\ResourceModel\CustomerStatusResource;

/**
 * Save CustomerStatus Command.
 */
class SaveCommand
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var CustomerStatusModelFactory
     */
    private $modelFactory;

    /**
     * @var CustomerStatusResource
     */
    private $resource;

    /**
     * @param LoggerInterface $logger
     * @param CustomerStatusModelFactory $modelFactory
     * @param CustomerStatusResource $resource
     */
    public function __construct(
        LoggerInterface $logger,
        CustomerStatusModelFactory $modelFactory,
        CustomerStatusResource $resource
    ) {
        $this->logger = $logger;
        $this->modelFactory = $modelFactory;
        $this->resource = $resource;
    }

    /**
     * Save CustomerStatus.
     *
     * @param CustomerStatusInterface $customerStatus
     *
     * @return int
     * @throws CouldNotSaveException
     */
    public function execute(CustomerStatusInterface $customerStatus): int
    {
        try {
            /** @var CustomerStatusModel $model */
            $model = $this->modelFactory->create();
            $model->addData($customerStatus->getData());
            $model->setHasDataChanges(true);

            if (!$model->getData(CustomerStatusInterface::ID)) {
                $model->isObjectNew(true);
            }
            $this->resource->save($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not save CustomerStatus. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotSaveException(__('Could not save CustomerStatus.'));
        }

        return (int)$model->getData(CustomerStatusInterface::ID);
    }
}
