<?php

namespace App\EventListener;

use App\Exception\Auth\AuthorizationException;
use App\Exception\Document\Task\SaveTaskException;
use App\ObjectValue\ResultStatusEnum;
use App\ObjectValue\ValidationExceptionResult\ValidationExceptionResult;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class AuthorizationExceptionListener
{
    /**
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event)
    {
        if ($event->getException() instanceof AuthorizationException) {
            /** @var SaveTaskException $exception */
            $exception = $event->getException();

            $validateExceptionResult = new ValidationExceptionResult(ResultStatusEnum::failed(), [$exception]);
            $response = new JsonResponse($validateExceptionResult);

            $event->setResponse($response);
        }
    }
}