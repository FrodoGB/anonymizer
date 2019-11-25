<?php

namespace App\Request;

use App\Exception\Auth\AuthorizationException;
use App\Exception\ValidationException;
use App\Traits\ValidationAwareTrait;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\FileBag;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\ServerBag;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class BaseValidation
 *
 * @property ParameterBag $attributes
 * @property ParameterBag $request
 * @property ParameterBag $query
 * @property ServerBag $server
 * @property FileBag $files
 * @property ParameterBag $cookies
 * @property HeaderBag $headers
 *
 * @method   duplicate(array $query, array $request, array $attributes, array $cookies, array $files, array $server)
 * @method   overrideGlobals()
 */
abstract class BaseValidation
{
    use ValidationAwareTrait;

    /** @var ValidatorInterface */
    private $validator;

    /** @var ContainerInterface $container */
    protected $container;

    public function __construct(RequestStack $request, ContainerInterface $container)
    {
        $this->httpRequest = $request->getCurrentRequest();
        $this->validator = Validation::createValidator();
        $this->container = $container;

        $this->initialize();
    }

    public function initialize(): void
    {
        $this->passesAuthorization();

        $this->validate();
    }

    /**
     * Get all request parameters
     *
     * @return array
     */
    public function all(): array
    {
        return $this->httpRequest->attributes->all() + $this->httpRequest->query->all() + $this->httpRequest->request->all() + $this->httpRequest->files->all();
    }

    /**
     * Returns list of constraints for validation
     *
     * @return Collection
     */
    abstract public function rules(): Collection;

    /**
     * Determine if the request passes the authorization check.
     *
     * @return bool
     */
    protected function passesAuthorization(): bool
    {
        $authorizationToken = $this->httpRequest->headers->get('authorization');
        if ($authorizationToken === null) throw AuthorizationException::forNotExistingToken();

        return $this->authorize($authorizationToken);
    }

    /**
     * @return bool
     * @throws ValidationException
     */
    protected function validate(): bool
    {
        /** @var ConstraintViolationList $violations */
        $violations = $this->validator->validate($this->all(), $this->rules());

        if ($violations->count()) {
            throw new ValidationException($this->validator, $violations);
        }

        return true;
    }

    /**
     * @param string $authorizationToken
     *
     * @return bool
     */
    protected function authorize(string $authorizationToken): bool
    {
        $token = str_replace('Bearer ', '', $authorizationToken);

        if ($this->checkToken($token) && $this->checkAllowedClientIp()) return false;

        return true;
    }

    /**
     * @param string $authorizeToken
     *
     * @return bool
     */
    private function checkToken(string $authorizeToken): bool
    {
        if ($authorizeToken !== $this->container->getParameter('perm_token')) throw AuthorizationException::forNotCorrectToken();

        return true;
    }

    /**
     * @return bool
     */
    private function checkAllowedClientIp(): bool
    {
        if (!in_array($this->httpRequest->getClientIp(), $this->container->getParameter('allowed_ip'))) throw AuthorizationException::forNotAllowedClientIp();

        return true;
    }
}