<?php

namespace App\Request;

use App\Repository\TaskRepository;
use Symfony\Component\Validator\Constraints\{Choice, Collection, NotBlank, NotNull, Positive, Required};
use Symfony\Component\Validator\Exception\{ConstraintDefinitionException,
    InvalidOptionsException,
    MissingOptionsException};

class RegisterTaskRequest extends BaseValidation
{
    private const ALLOW_EXTRA_FIELDS = true;
    private const ALLOW_MISSING_FIELDS = false;
    private const EXTRA_FIELDS_MESSAGE = 'This field was not expected.';
    private const MISSING_FIELDS_MESSAGE = 'This field is missing.';

    /**
     * @return Collection
     * @throws MissingOptionsException
     * @throws InvalidOptionsException
     * @throws ConstraintDefinitionException
     */
    public function rules(): Collection
    {
        return new Collection([
            'fields' => $this->getFields(),
            'allowExtraFields' => self::ALLOW_EXTRA_FIELDS,
            'allowMissingFields' => self::ALLOW_MISSING_FIELDS,
            'extraFieldsMessage' => self::EXTRA_FIELDS_MESSAGE,
            'missingFieldsMessage' => self::MISSING_FIELDS_MESSAGE,
        ]);
    }

    /**
     * @return array
     * @throws MissingOptionsException
     * @throws InvalidOptionsException
     * @throws ConstraintDefinitionException
     */
    private function getFields(): array
    {
        return [
            'userId' => new Required([
                new NotBlank(),
                new NotNull(),
                new Positive(),
            ]),
            'acceptUserId' => new Required([
                new NotBlank(),
                new Positive(),
            ]),
            'reason' => new Required([
                new NotBlank(),
                new NotNull(),
            ]),
            'systemName' => new Required([
                new NotBlank(),
                new NotNull(),
                new Choice(
                    $this->container->getParameter('allowed_system')
                ),
            ]),
        ];
    }
}