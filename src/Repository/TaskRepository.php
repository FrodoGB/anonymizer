<?php

namespace App\Repository;

use App\Anonymizer\Command\RegisterTask\RegisterTaskCommand;
use App\Document\Status;
use App\Document\Task;
use App\Exception\Document\Task\SaveTaskException;
use App\ObjectValue\ResultStatusEnum;
use App\ObjectValue\StatusNameEnum;
use Doctrine\ODM\MongoDB\DocumentRepository;

class TaskRepository extends DocumentRepository
{
    /**
     * @param RegisterTaskCommand $command
     *
     * @return Task
     */
    public function addNew(RegisterTaskCommand $command)
    {
        $statusPending = $this->dm->getRepository(Status::class)->findOneBy([
                'name' => StatusNameEnum::pending()->getValue(),
            ]);

        $newTask = new Task($command);
        $newTask->setStatus($statusPending);
        $this->dm->persist($newTask);
        $this->dm->flush();

        if ($newTask->getId() === null) {
            throw SaveTaskException::forRegisterTaskCommand();
        }

        return $newTask;
    }
}