<?php

namespace Digi\Exceptions;

use RuntimeException;

class NotEnoughPhotosException extends RuntimeException
{
    public static function make(int $minCount) : self
    {
        return new self("Your account plan does not allow albums with less than $minCount photos");
    }
}
