<?php

namespace Digi\Jobs;

use App\Models\Album;
use Digi\Events\CompilationFailed;
use Digi\Events\CompilationFinished;
use Digi\Exceptions\NotEnoughPhotosException;
use Digi\Exceptions\PhotobombingLevelsTooLowException;
use Digi\Exceptions\TooManyPhotosException;
use Faker\Generator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessAlbum implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Album $album;

    private int $minCount;

    private int $maxCount;

    private int $chanceOfPhotobombingException;

    public function __construct(Album $album)
    {
        $this->album = $album;
        $this->minCount = config('services.digi_compiler.min_album_photo_count');
        $this->maxCount = config('services.digi_compiler.max_album_photo_count');
        $this->chanceOfPhotobombingException = config('services.digi_compiler.chance_of_low_photobombing_levels_exception');
    }

    public function handle(Generator $faker)
    {
        if ($this->album->photos->count() < $this->minCount) {
            event(new CompilationFailed($this->album, NotEnoughPhotosException::make($this->minCount)));

            return;
        }

        if ($this->album->photos->count() > $this->maxCount) {
            event(new CompilationFailed($this->album, TooManyPhotosException::make($this->maxCount)));

            return;
        }

        if ($faker->boolean($this->chanceOfPhotobombingException)) {
            event(new CompilationFailed($this->album, PhotobombingLevelsTooLowException::make()));

            return;
        }

        // processed!
        event(new CompilationFinished($this->album));
    }
}
