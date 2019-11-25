<?php

namespace App\ObjectValue\CommandResult;

use App\ObjectValue\ResultInterface;
use App\ObjectValue\ResultStatusEnum;
use App\Traits\ObjectPropertiesTrait;
use JsonSerializable;

class CommandResult implements ResultInterface, JsonSerializable
{
    use ObjectPropertiesTrait;

    /** @var ResultStatusEnum $status */
    private $status;

    /** @var array|null $payload */
    private $payload;

    /** @var array|null $errors */
    private $errors;

    /**
     * CommandStatus constructor.
     *
     * @param ResultStatusEnum $status
     * @param array|null $payload
     * @param array|null $errors
     */
    public function __construct(ResultStatusEnum $status = null, ?array $payload = null, ?array $errors = null)
    {
        $this->status = $status;
        $this->payload = $payload;
        $this->errors = $errors;
    }

    /**
     * @param ResultStatusEnum $status
     */
    public function setStatus(ResultStatusEnum $status): void
    {
        $this->status = $status;
    }

    /**
     * @param array|null $payload
     */
    public function setPayload(array $payload = null): void
    {
        $this->payload = $payload;
    }

    /**
     * @param array|null $errors
     */
    public function setErrors(array $errors = null): void
    {
        $this->errors = $errors;
    }
}