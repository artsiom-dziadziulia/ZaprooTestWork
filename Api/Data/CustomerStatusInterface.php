<?php
declare(strict_types=1);

namespace Zaproo\TestWork\Api\Data;

interface CustomerStatusInterface
{
    /**
     * String constants for property names
     */
    const ID = "id";
    const CUSTOMER_ID = "customer_id";
    const STATUS = "status";

    /**
     * Getter for CustomerId.
     *
     * @return int|null
     */
    public function getCustomerId(): ?int;

    /**
     * Setter for CustomerId.
     *
     * @param int|null $customerId
     *
     * @return void
     */
    public function setCustomerId(?int $customerId): void;

    /**
     * Getter for Status.
     *
     * @return string|null
     */
    public function getStatus(): ?string;

    /**
     * Setter for Status.
     *
     * @param string|null $status
     *
     * @return void
     */
    public function setStatus(?string $status): void;
}
