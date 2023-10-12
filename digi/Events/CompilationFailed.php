<?php

namespace Digi\Events;

use App\Models\Album;
use Throwable;

class CompilationFailed
{
    public Album $album;

    public Throwable $throwable;

    public function __construct(Album $album, Throwable $throwable)
    {
        $this->album = $album;
        $this->throwable = $throwable;
    }
}
