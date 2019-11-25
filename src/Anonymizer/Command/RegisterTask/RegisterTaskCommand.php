<?php

namespace App\Anonymizer\Command\RegisterTask;

class RegisterTaskCommand
{
    /** @var int $userId */
    private $userId;

    /** @var int $acceptUserId */
    private $acceptUserId;

    /** @var string $reason */
    private $reason;

    /** @var string $systemName */
    private $systemName;

    /**
     * RegisterUserCommand constructor.
     *
     * @param array $requestParams
     */
    public function __construct(array $requestParams)
    {
        $this->userId = (int) $requestParams['userId'];
        $this->acceptUserId = (int) $requestParams['acceptUserId'];
        $this->reason = $requestParams['reason'];
        $this->systemName = $requestParams['systemName'];
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getAcceptUserId(): int
    {
        return $this->acceptUserId;
    }

    /**
     * @return string
     */
    public function getReason(): string
    {
        return $this->reason;
    }

    /**
     * @return string
     */
    public function getSystemName(): string
    {
        return $this->systemName;
    }
}