<?php

namespace Digi\Services;

use App\Models\Album;
use App\Services\AlbumCompiler;
use Digi\Jobs\ProcessAlbum;

class DigiAlbumCompiler implements AlbumCompiler
{
    public function compile(Album $album)
    {
        // imagine there's some lengthy processing happening in the background
        ProcessAlbum::dispatch($album)
            ->delay($album->photos->count() * config('services.digi_compiler.delay_multiplier'));
    }
}
