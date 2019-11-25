<?php

namespace App\Exception\Auth;

use App\Traits\ObjectPropertiesTrait;
use JsonSerializable;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class AuthorizationException extends AccessDeniedException implements JsonSerializable
{
    use ObjectPropertiesTrait;

    protected $hidden = [
        'trace',
    ];

    /**
     * @return AuthorizationException
     */
    public static function forNotExistingToken()
    {
        return new self('Bad Request! PermToken not exist.');
    }

    /**
     * @return AuthorizationException
     */
    public static function forNotCorrectToken()
    {
        return new self('Bad Request! PermToken is not correct.');
    }

    /**
     * @return AuthorizationException
     */
    public static function forNotAllowedClientIp()
    {
        return new self('Bad Request! ClientIp is not allowed.');
    }
}