<?php

namespace App\Anonymizer\Command\RegisterTask;

use App\Document\Status;
use App\Document\Task;
use App\Anonymizer\Command\BundleCommandHandler;
use App\ObjectValue\CommandResult\CommandResult;
use App\ObjectValue\ResultStatusEnum;

class RegisterTaskCommandHandler extends BundleCommandHandler
{
    /**
     * @param RegisterTaskCommand $command
     *
     * @return CommandResult
     */
    public function handle(RegisterTaskCommand $command): CommandResult
    {
        $result = $this->documentManager
            ->getRepository(Task::class)
            ->addNew($command);

        return new CommandResult(ResultStatusEnum::success(), [$result]);
    }
}