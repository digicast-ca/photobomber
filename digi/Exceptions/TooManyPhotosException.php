<?php

namespace Digi\Exceptions;

use RuntimeException;

class TooManyPhotosException extends RuntimeException
{
    public static function make(int $maxCount) : self
    {
        return new self("Your account plan does not allow albums with more than $maxCount photos");
    }
}
