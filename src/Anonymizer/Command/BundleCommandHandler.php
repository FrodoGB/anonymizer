<?php

namespace App\Anonymizer\Command;

use Doctrine\ODM\MongoDB\DocumentManager;

class BundleCommandHandler
{
    /** @var DocumentManager $documentManager */
    protected $documentManager;

    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }
}