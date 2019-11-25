<?php

namespace App\Document;

use App\Anonymizer\Command\RegisterTask\RegisterTaskCommand;
use App\Traits\ObjectPropertiesTrait;
use Carbon\Carbon;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceOne;
use JsonSerializable;

/**
 * Class Statuses
 * @ODM\Document(collection="tasks", repositoryClass="App\Repository\TaskRepository")
 * @ODM\HasLifecycleCallbacks()
 * @ODM\Indexes(
 *     @ODM\Index(keys={"systemName"="asc"})
 * )
 */
class Task implements JsonSerializable
{
    use ObjectPropertiesTrait;

    protected $hidden = [
        'updatedAt',
    ];

    /**
     * @ODM\Id()
     */
    protected $id;

    /**
     * @ODM\Field(type="int")
     */
    protected $userId;

    /**
     * @ODM\Field(type="int")
     */
    protected $acceptedUserId;

    /**
     * @ODM\Field(type="string")
     */
    protected $reason;

    /**
     * @ODM\Field(type="string")
     */
    protected $systemName;

    /**
     * @ReferenceOne(targetDocument="Status")
     */
    protected $status;

    /**
     * @ODM\Field(type="date")
     */
    protected $createdAt;

    /**
     * @ODM\Field(type="date")
     */
    protected $updatedAt;

    public function __construct(RegisterTaskCommand $command)
    {
        $this->setUserId($command->getUserId());
        $this->setAcceptedUserId($command->getAcceptUserId());
        $this->setReason($command->getReason());
        $this->setSystemName($command->getSystemName());
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getAcceptedUserId()
    {
        return $this->acceptedUserId;
    }

    /**
     * @param mixed $acceptedUserId
     */
    public function setAcceptedUserId($acceptedUserId): void
    {
        $this->acceptedUserId = $acceptedUserId;
    }

    /**
     * @return mixed
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @param mixed $reason
     */
    public function setReason($reason): void
    {
        $this->reason = $reason;
    }

    /**
     * @return mixed
     */
    public function getSystemName()
    {
        return $this->systemName;
    }

    /**
     * @param $systemName
     */
    public function setSystemName($systemName): void
    {
        $this->systemName = $systemName;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @ODM\PreFlush()
     */
    public function prePersist()
    {
        $this->createdAt = $this->updatedAt = Carbon::now()->toDateTimeString();
    }
}