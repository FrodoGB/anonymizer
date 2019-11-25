<?php

namespace App\Anonymizer\Controller;

use App\Document\Task;
use App\Exception\Document\Task\SaveTaskException;
use App\ObjectValue\CommandResult\CommandResult;
use App\Request\RegisterTaskRequest;
use App\Anonymizer\Command\RegisterTask\RegisterTaskCommand;
use Doctrine\ODM\MongoDB\DocumentManager;
use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class MainController extends AbstractController
{
    /**
     * @param DocumentManager $documentManager
     *
     * @return JsonResponse
     */
    public function index(DocumentManager $documentManager)
    {
    }

    /**
     * @param CommandBus $commandBus
     * @param RegisterTaskRequest $request
     *
     * @return JsonResponse
     */
    public function store(CommandBus $commandBus, RegisterTaskRequest $request)
    {
        /** @var CommandResult $result */
        $result = $commandBus->handle(new RegisterTaskCommand($request->all()));

        return new JsonResponse($result);
    }
}