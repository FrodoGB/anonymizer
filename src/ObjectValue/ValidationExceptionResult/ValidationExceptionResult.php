<?php

namespace App\ObjectValue\ValidationExceptionResult;

use App\ObjectValue\ResultInterface;
use App\ObjectValue\ResultStatusEnum;
use JsonSerializable;

class ValidationExceptionResult implements ResultInterface, JsonSerializable
{
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

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'status' => $this->status,
            'payload' => $this->payload,
            'errors' => $this->errors,
        ];
    }
}