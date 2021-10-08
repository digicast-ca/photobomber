<?php

namespace App\Services;

use App\Models\Album;

interface AlbumCompiler
{
    public function compile(Album $album);
}
