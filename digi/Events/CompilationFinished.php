<?php

namespace Digi\Events;

use App\Models\Album;

class CompilationFinished
{
    public Album $album;

    public function __construct(Album $album)
    {
        $this->album = $album;
    }
}
