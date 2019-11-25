<?php

namespace App\Exception\Document\Task;

use App\Traits\ObjectPropertiesTrait;
use JsonSerializable;

/**
 * Class SaveTaskException
 * @package App\Exception\Document\Task
 */
class SaveTaskException extends TaskDocumentsException implements JsonSerializable
{
    use ObjectPropertiesTrait;

    /**
     * @return SaveTaskException
     */
    public static function forRegisterTaskCommand()
    {
        return new self(sprintf('Error while saving to database task created by RegisterTaskCommand.'));
    }
}