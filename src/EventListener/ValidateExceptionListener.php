<?php

namespace App\EventListener;

use App\Exception\ValidationException;
use App\ObjectValue\ResultStatusEnum;
use App\ObjectValue\ValidationExceptionResult\ValidationExceptionResult;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ValidateExceptionListener
{
    /**
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event)
    {
        if ($event->getException() instanceof ValidationException) {
            /** @var ValidationException $exception */
            $exception = $event->getException();

            $validateExceptionResult = new ValidationExceptionResult(ResultStatusEnum::failed(), $exception->getResponseData());
            $response = new JsonResponse($validateExceptionResult);

            $event->setResponse($response);
        }
    }
}