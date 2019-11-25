<?php

namespace App\Document;

use Carbon\Carbon;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Class Statuses
 * @ODM\Document(collection="logs", )
 * @ODM\HasLifecycleCallbacks()
 */
class Log
{
    /**
     * @ODM\Id()
     */
    protected $id;

    /**
     * @ODM\Field(type="string")
     */
    protected $level;

    /**
     * @ODM\Field(type="string")
     */
    protected $message;

    /**
     * @ODM\Field(type="collection")
     */
    protected $context;

    /**
     * @ODM\Field(type="date")
     */
    protected $createdAt;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct(string $level, string $message, $context)
    {
        $this->level = $level;
        $this->message = $message;
        $this->context = $context;
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
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param String $level
     */
    public function setLevel(string $level): void
    {
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param mixed $context
     */
    public function setContext($context): void
    {
        $this->context = $context;
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
     * @ODM\PrePersist()
     */
    public function prePersist()
    {
        $this->createdAt = Carbon::now()->toDateTimeString();
    }
}