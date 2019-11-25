<?php

namespace App\ObjectValue;

interface ResultInterface
{
    public function setStatus(ResultStatusEnum $status);
    public function setPayload(array $payload = null);
    public function setErrors(array $error  = null);
}