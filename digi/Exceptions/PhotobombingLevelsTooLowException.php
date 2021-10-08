<?php

namespace Digi\Exceptions;

use RuntimeException;

class PhotobombingLevelsTooLowException extends RuntimeException
{
    public static function make() : self
    {
        return new self('Our AI minions have scanned your photobombing levels as too low');
    }
}
